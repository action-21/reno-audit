<?php

namespace App\Domain\Moteur3CL\Apport;

use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\SseBaieCollection;
use App\Domain\Moteur3CL\Common\{DataStore, Mois};
use App\Domain\Moteur3CL\Constants;

/**
 * @see §6
 */
final class Apport
{
    use DataStore;

    private ApportInput $input;

    public function __construct(
        private SseBaieCollection $sse_baie_collection,
    ) {
    }

    /**
     * F,j - Fraction des besoins de chauffage couverts par les apports gratuits pour le mois j
     */
    public function f_j(Mois $mois, bool $scenario_depensier = false): float
    {
        $exposant = $this->input->classe_inertie()->exposant();
        $xj = ($gv = $this->input->gv() * $this->input->dh_ch_j($mois, $scenario_depensier)) > 0
            ? $this->apport_ch_j($mois, $scenario_depensier) / $gv
            : 0;

        return ($xj - \pow($xj, $exposant)) / (1 - \pow($xj, $exposant));
    }

    /**
     * Apports solaires moyens annuels sur la période de chauffe (Wh)
     */
    public function apport_solaire_ch(bool $scenario_depensier = false): float
    {
        return \array_reduce(Mois::cases(), fn (Mois $mois, float $ai): float => $ai += $this->apport_solaire_ch_j($mois, $scenario_depensier), 0);
    }

    /**
     * Apports internes moyens annuels sur la période de chauffe (Wh)
     */
    public function apport_interne_ch(bool $scenario_depensier = false): float
    {
        return \array_reduce(Mois::cases(), fn (Mois $mois, float $ai): float => $ai += $this->apport_interne_ch_j($mois, $scenario_depensier), 0);
    }

    /**
     * Apports solaires moyens annuels sur la période de refroidissement (Wh)
     */
    public function apport_solaire_fr(bool $scenario_depensier = false): float
    {
        return \array_reduce(Mois::cases(), fn (Mois $mois, float $ai): float => $ai += $this->apport_solaire_fr_j($mois, $scenario_depensier), 0);
    }

    /**
     * Apports internes moyens annuels sur la période de refroidissement (Wh)
     */
    public function apport_interne_fr(bool $scenario_depensier = false): float
    {
        return \array_reduce(Mois::cases(), fn (Mois $mois, float $ai): float => $ai += $this->apport_interne_fr_j($mois, $scenario_depensier), 0);
    }

    /**
     * Apports moyens sur la période de chauffe pour le mois j (Wh)
     */
    public function apport_ch_j(Mois $mois, bool $scenario_depensier = false): float
    {
        return $this->apport_solaire_ch_j($mois, $scenario_depensier) + $this->apport_interne_ch_j($mois, $scenario_depensier);
    }

    /**
     * Apports moyens sur la période de refroidissement pour le mois j (Wh)
     */
    public function apport_fr_j(Mois $mois, bool $scenario_depensier = false): float
    {
        return $this->apport_solaire_fr_j($mois, $scenario_depensier) + $this->apport_interne_fr_j($mois, $scenario_depensier);
    }

    /**
     * Apports solaires moyens sur la période de chauffe pour le mois j(Wh)
     */
    public function apport_solaire_ch_j(Mois $mois, bool $scenario_depensier = false): float
    {
        return 1000 * $this->sse_baie_collection()->sse_j($mois, $scenario_depensier) * $this->input->e_j($mois);
    }

    /**
     * Apports solaires moyens sur la période de refroidissement pour le mois j(Wh)
     */
    public function apport_solaire_fr_j(Mois $mois, bool $scenario_depensier = false): float
    {
        return 1000 * $this->sse_baie_collection()->sse_j($mois, $scenario_depensier) * $this->input->e_fr_j($mois);
    }

    /**
     * Apports internes moyens sur la période de chauffe pour le mois j (Wh)
     */
    public function apport_interne_ch_j(Mois $mois, bool $scenario_depensier = false): float
    {
        $puissance = $this->apport_interne_equipements() + $this->apport_interne_eclairage() + $this->apport_interne_occupant();
        return $puissance * $this->input->nref_ch_j($mois, $scenario_depensier);
    }

    /**
     * Apports internes moyens sur la période de refroidissement pour le mois j (Wh)
     */
    public function apport_interne_fr_j(Mois $mois, bool $scenario_depensier = false): float
    {
        $puissance = $this->apport_interne_equipements() + $this->apport_interne_eclairage() + $this->apport_interne_occupant();
        return $puissance * $this->input->nref_fr_j($mois, $scenario_depensier);
    }

    /**
     * Apports internes moyens dus aux équipements sur une semaine type (W)
     */
    public function apport_interne_equipements(): float
    {
        $puissance = Constants::PUISSANCE_CHALEUR_EQUIPEMENT_OCCUPATION * (Constants::PERIODE_OCCUPATION_HEBDOMADAIRE / 168);
        $puissance += Constants::PUISSANCE_CHALEUR_EQUIPEMENT_INOCCUPATION * (Constants::PERIODE_INOCCUPATION_HEBDOMADAIRE / 168);
        $puissance += Constants::PUISSANCE_CHALEUR_EQUIPEMENT_SOMMEIL * (Constants::PERIODE_SOMMEIL_HEBDOMADAIRE / 168);
        return $puissance * $this->input->surface_habitable();
    }

    /**
     * Apports internes moyens dus à l'éclairage (W)
     */
    public function apport_interne_eclairage(): float
    {
        return Constants::PUISSANCE_ECLAIRAGE * (2123 / 8760) * $this->input->surface_habitable();
    }

    /**
     * Apports internes moyens dus aux occupants du logement (W)
     */
    public function apport_interne_occupant(): float
    {
        return Constants::PUISSANCE_CHALEUR_NADEQ * $this->input->nadeq() * (2123 / 8760);
    }

    /**
     * Surface sud équivalente des baies
     */
    public function sse_baie_collection(): SseBaieCollection
    {
        return $this->has('sse_baie_collection')
            ? $this->get('sse_baie_collection')
            : $this->set('sse_baie_collection', ($this->sse_baie_collection)($this->input->baie_collection()));
    }

    public function __invoke(ApportInput $input): self
    {
        $this->input = $input;

        return $this;
    }
}
