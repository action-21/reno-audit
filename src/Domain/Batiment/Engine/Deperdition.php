<?php

namespace App\Domain\Batiment\Engine;

use App\Domain\Batiment\Batiment;
use App\Domain\Lnc\LncEngine;
use App\Domain\MasqueLointain\MasqueLointainEngine;
use App\Domain\MasqueProche\MasqueProcheEngine;
use App\Domain\Paroi\Enum\QualiteComposant;
use App\Domain\Mur\MurEngine;
use App\Domain\PlancherBas\PlancherBasEngine;
use App\Domain\PlancherHaut\PlancherHautEngine;
use App\Domain\PontThermique\PontThermiqueEngine;
use App\Domain\Porte\PorteEngine;

/**
 * @see §3 Calcul des déperditions de l’enveloppe GV
 */
final class Deperdition
{
    private Batiment $input;

    public function __construct(
        private LncEngine $lnc_engine,
        private MasqueProcheEngine $masque_proche_engine,
        private MasqueLointainEngine $masque_lointain_engine,
        private MurEngine $mur_engine,
        private PlancherBasEngine $plancher_bas_engine,
        private PlancherHautEngine $plancher_haut_engine,
        private PorteEngine $porte_engine,
        private PontThermiqueEngine $pont_thermique_engine,
    ) {
    }

    /**
     * Ubat - Performance de l'enveloppe ((W/(m².K))
     */
    public function ubat(): ?float
    {
        return ($sdep = $this->sdep()) ? $this->gv() / $sdep : null;
    }

    /**
     * GV - Déperditions thermiques de l'enveloppe (W/K)
     */
    public function gv(): float
    {
        return $this->dp() + $this->pt() + $this->dr();
    }

    /**
     * DR - Déperditions thermiques par le renouvellement d’air (W/K)
     */
    public function dr(): float
    {
        return $this->deperdition_ventilation()?->dr() ?? 0;
    }

    /**
     * PT - Déperditions thermiques par les ponts thermiques (W/K)
     */
    public function pt(): float
    {
        return $this->pont_thermique_engine()->deperdition_pont_thermique_collection()->pt();
    }

    /**
     * DP - Déperditions thermiques par les parois (W/K)
     */
    public function dp(): float
    {
        return \array_sum([
            $this->mur_engine()->deperdition_mur_collection()->dp(),
            $this->plancher_haut_engine()->deperdition_plancher_haut_collection()->dp(),
            $this->plancher_bas_engine()->deperdition_plancher_bas_collection()->dp(),
            $this->porte_engine()->deperdition_porte_collection()->dp(),
        ]);
    }

    /**
     * sdep - Surface déperditive de l'enveloppe (m²)
     */
    public function sdep(): float
    {
        return \array_sum([
            $this->mur_engine()->deperdition_mur_collection()->sdep(),
            $this->plancher_haut_engine()->deperdition_plancher_haut_collection()->sdep(),
            $this->plancher_bas_engine()->deperdition_plancher_bas_collection()->sdep(),
            $this->porte_engine()->deperdition_porte_collection()->sdep(),
        ]);
    }

    /**
     * Indicateur de performance de l'enveloppe
     */
    public function qualite_isolation(): ?QualiteComposant
    {
        return ($ubat = $this->ubat()) ? QualiteComposant::from_ubat($ubat) : null;
    }

    public function lnc_engine(): LncEngine
    {
        return $this->lnc_engine;
    }

    public function masque_proche_engine(): MasqueProcheEngine
    {
        return $this->masque_proche_engine;
    }

    public function masque_lointain_engine(): MasqueLointainEngine
    {
        return $this->masque_lointain_engine;
    }

    public function mur_engine(): MurEngine
    {
        return $this->mur_engine;
    }

    public function plancher_bas_engine(): PlancherBasEngine
    {
        return $this->plancher_bas_engine;
    }

    public function plancher_haut_engine(): PlancherHautEngine
    {
        return $this->plancher_haut_engine;
    }

    public function porte_engine(): PorteEngine
    {
        return $this->porte_engine;
    }

    public function pont_thermique_engine(): PontThermiqueEngine
    {
        return $this->pont_thermique_engine;
    }

    public function input(): Batiment
    {
        return $this->input;
    }

    public function __invoke(Batiment $input): self
    {
        $this->input = $input;
        $this->lnc_engine = ($this->lnc_engine)($input->lnc_collection());
        $this->masque_proche_engine = ($this->masque_proche_engine)($input->masque_proche_collection());
        $this->masque_lointain_engine = ($this->masque_lointain_engine)($input->masque_lointain_collection());
        $this->mur_engine = ($this->mur_engine)($input->mur_collection(), $this);
        $this->plancher_haut_engine = ($this->plancher_haut_engine)($input->plancher_haut_collection(), $this);
        $this->plancher_bas_engine = ($this->plancher_bas_engine)($input->plancher_bas_collection(), $this);
        $this->porte_engine = ($this->porte_engine)($input->porte_collection(), $this);
        $this->pont_thermique_engine = ($this->pont_thermique_engine)($input->pont_thermique_collection());

        return $this;
    }
}
