<?php

namespace App\Domain\Batiment\Engine;

use App\Domain\Batiment\Batiment;
use App\Domain\Common\Store\DataStore;

/**
 * @see §10.1
 * @see §10.2
 */
final class Refroidissement
{
    use DataStore;

    private Batiment $input;

    /**
     * ∑cfr - Somme des consommations de refroidissement (kWh)
     */
    public function cfr(bool $scenario_depensier = false, bool $energie_primaire = false): float
    {
        return $this->climatisation_collection()->cfr($scenario_depensier, $energie_primaire);
    }

    /**
     * ∑cfr,j - Somme des consommations de refroidissement pour le mois j (kWh)
     */
    public function cfr_j(Mois $mois, bool $scenario_depensier = false): float
    {
        return $this->climatisation_collection()->cfr_j($mois, $scenario_depensier);
    }

    /**
     * Bfr - Besoin annuel de refroidissement (Wh)
     */
    public function bfr(bool $scenario_depensier = false): float
    {
        return $this->bfr_collection($scenario_depensier)->reduce(fn (float $bfr_j, float $bfr): float => $bfr += $bfr_j, 0);
    }

    /**
     * Bfr,j - Besoin de refroidissement pour le mois j (Wh)
     */
    public function bfr_j(Mois $mois, bool $scenario_depensier = false): float
    {
        if ($this->bfr_collection($scenario_depensier)->has($mois)) {
            return $this->bfr_collection($scenario_depensier)->get($mois);
        }
        if ((1 / 2) > $this->rbth_j($mois, $scenario_depensier)) {
            return 0;
        }

        $gv = $this->input->gv();
        $apport_j = $this->input->apport_fr_j($mois, $scenario_depensier);
        $nref_j = $this->input->nref_fr_j($mois, $scenario_depensier);
        $text_moy_clim_j = $this->input->text_moy_clim_j($mois, $scenario_depensier);
        $tint = $this->tint($scenario_depensier);
        $fut_j = $this->fut_j($mois, $scenario_depensier);

        $value = ($apport_j / 1000) - $fut_j * ($gv / 1000) * ($tint - $text_moy_clim_j) * $nref_j * 1000;

        return $this->bfr_collection($scenario_depensier)->set($mois, $value);
    }

    /**
     * Collection de valeurs pour bfr_j
     */
    public function bfr_collection(bool $scenario_depensier): MoisCollection
    {
        $key = $scenario_depensier ? 'bfr_depensier' : 'bfr';
        return $this->has($key) ? $this->get($key) : $this->set($key, new MoisCollection);
    }

    /**
     * fut,j - Facteur d'utilisation des apports sur le mois j
     */
    public function fut_j(Mois $mois, bool $scenario_depensier = false): float
    {
        $rbth_j = $this->rbth_j($mois, $scenario_depensier);
        $alpha = 1 + $this->t() / 15;

        if ($rbth_j === 1) {
            return $alpha / $alpha + 1;
        }
        if ($rbth_j > 0 && $rbth_j < 1) {
            return (1 - \pow($rbth_j, $alpha * (-1))) / (1 - \pow($rbth_j, $alpha * (-1) - 1));
        }
        return 0;
    }

    /**
     * Rbth,j - Ratio de bilan thermique sur le mois j
     */
    public function rbth_j(Mois $mois, bool $scenario_depensier = false): float
    {
        if ($this->rbth_collection($scenario_depensier)->has($mois)) {
            return $this->rbth_collection($scenario_depensier)->get($mois);
        }

        $gv = $this->input->gv();
        $apport_j = $this->input->apport_fr_j($mois, $scenario_depensier);
        $nref_j = $this->input->nref_fr_j($mois, $scenario_depensier);
        $text_moy_clim_j = $this->input->text_moy_clim_j($mois, $scenario_depensier);
        $tint = $this->tint($scenario_depensier);

        $value = ($besoin = ($text_moy_clim_j - $tint) * $gv * $nref_j) ? \min($apport_j / $besoin, 1) : null;

        return $this->rbth_collection($scenario_depensier)->set($mois, $value);
    }

    /**
     * Collection de valeurs pour rbth
     */
    public function rbth_collection(bool $scenario_depensier = false): MoisCollection
    {
        $key = $scenario_depensier ? 'rbth_depensier' : 'rbth';
        return $this->has($key) ? $this->get($key) : $this->set($key, new MoisCollection);
    }

    /**
     * t - Constante de temps de la zone pour le refroidissement
     */
    public function t(): float
    {
        return 0 < ($gv = $this->input->gv()) ? $this->cin() / (3600 * $gv) : 0;
    }

    /**
     * Cin - Capacité thermique intérieure efficace de la zone (J/K)
     */
    public function cin(): float
    {
        return $this->input->classe_inertie()->cin() * $this->input->surface_habitable();
    }

    /**
     * Tint - Température intérieur de consigne (°C)
     */
    public function tint(bool $scenario_depensier = false): float
    {
        return $scenario_depensier ? 26 : 28;
    }

    public function __invoke(Batiment $input): self
    {
        $this->input = $input;

        return $this;
    }
}
