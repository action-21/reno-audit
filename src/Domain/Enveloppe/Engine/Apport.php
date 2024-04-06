<?php

namespace App\Domain\Enveloppe\Engine;

use App\Domain\Baie\BaieEngine;
use App\Domain\Batiment\Engine\Eclairage;
use App\Domain\Common\Enum\Mois;
use App\Domain\Enveloppe\EnveloppeEngine;
use App\Domain\Lnc\LncEngine;

/**
 * @see §6
 * @see §11.1
 * @see §16.1
 */
final class Apport
{
    /**
     * Puissance convenionnelle de chaleur par nombre d'adultes équivalents (W)
     */
    final public const PUISSANCE_CHALEUR_NADEQ = 90;

    /**
     * Puissance conventionnelle de chaleur dégagée par l’ensemble des équipements en période d'occupation hors période de sommeil (W/m²)
     */
    final public const PUISSANCE_CHALEUR_EQUIPEMENT_OCCUPATION = 5.7;

    /**
     * Puissance conventionnelle de chaleur dégagée par l’ensemble des équipements en période d'inoccupation (W/m²)
     */
    final public const PUISSANCE_CHALEUR_EQUIPEMENT_INOCCUPATION = 1.1;

    /**
     * Puissance conventionnelle de chaleur dégagée par l’ensemble des équipements pendant le sommeil (W/m²)
     */
    final public const PUISSANCE_CHALEUR_EQUIPEMENT_SOMMEIL = 1.1;

    /**
     * Nombre d'heures d'occupation conventionnel sur une semaine (h)
     */
    final public const PERIODE_OCCUPATION_HEBDOMADAIRE = 76;

    /**
     * Nombre d'heures d'inoccupation conventionnel sur une semaine (h)
     */
    final public const PERIODE_INOCCUPATION_HEBDOMADAIRE = 36;

    /**
     * Nombre d'heures de sommeil conventionnel sur une semaine (h)
     */
    final public const PERIODE_SOMMEIL_HEBDOMADAIRE = 56;

    /**
     * Puissance d’éclairage conventionnelle (W/m2)
     */
    final public const PUISSANCE_ECLAIRAGE = Eclairage::PUISSANCE_ECLAIRAGE;

    private EnveloppeEngine $engine;

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
        return 1000 * $this->engine->baie_engine()->surface_sud_equivalente()->sse_j($mois, $scenario_depensier) * $this->engine->context()->situation()->e_j($mois);
    }

    /**
     * Apports solaires moyens sur la période de refroidissement pour le mois j(Wh)
     */
    public function apport_solaire_fr_j(Mois $mois, bool $scenario_depensier = false): float
    {
        return 1000 * $this->engine->baie_engine()->surface_sud_equivalente()->sse_j($mois, $scenario_depensier) * $this->engine->context()->situation()->e_fr_j($mois);
    }

    /**
     * Apports internes moyens sur la période de chauffe pour le mois j (Wh)
     */
    public function apport_interne_ch_j(Mois $mois, bool $scenario_depensier = false): float
    {
        $puissance = $this->apport_interne_equipements() + $this->apport_interne_eclairage() + $this->apport_interne_occupant();
        return $puissance * $this->engine->context()->situation()->nref_ch_j($mois, $scenario_depensier);
    }

    /**
     * Apports internes moyens sur la période de refroidissement pour le mois j (Wh)
     */
    public function apport_interne_fr_j(Mois $mois, bool $scenario_depensier = false): float
    {
        $puissance = $this->apport_interne_equipements() + $this->apport_interne_eclairage() + $this->apport_interne_occupant();
        return $puissance * $this->engine->context()->situation()->nref_fr_j($mois, $scenario_depensier);
    }

    /**
     * Apports internes moyens dus aux équipements sur une semaine type (W)
     */
    public function apport_interne_equipements(): float
    {
        $puissance = self::PUISSANCE_CHALEUR_EQUIPEMENT_OCCUPATION * (self::PERIODE_OCCUPATION_HEBDOMADAIRE / 168);
        $puissance += self::PUISSANCE_CHALEUR_EQUIPEMENT_INOCCUPATION * (self::PERIODE_INOCCUPATION_HEBDOMADAIRE / 168);
        $puissance += self::PUISSANCE_CHALEUR_EQUIPEMENT_SOMMEIL * (self::PERIODE_SOMMEIL_HEBDOMADAIRE / 168);
        return $puissance * $this->engine->context()->input()->caracteristique()->surface_habitable;
    }

    /**
     * Apports internes moyens dus à l'éclairage (W)
     */
    public function apport_interne_eclairage(): float
    {
        return self::PUISSANCE_ECLAIRAGE * (2123 / 8760) * $this->engine->context()->input()->caracteristique()->surface_habitable;
    }

    /**
     * Apports internes moyens dus aux occupants du logement (W)
     */
    public function apport_interne_occupant(): float
    {
        return self::PUISSANCE_CHALEUR_NADEQ * $this->engine->context()->occupation()->nadeq() * (2123 / 8760);
    }

    public function __invoke(EnveloppeEngine $engine): self
    {
        $this->engine = $engine;
        return $this;
    }
}
