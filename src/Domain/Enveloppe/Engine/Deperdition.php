<?php

namespace App\Domain\Enveloppe\Engine;

use App\Domain\Enveloppe\Enum\QualiteComposant;
use App\Domain\Enveloppe\EnveloppeEngine;

/**
 * @see §3 Calcul des déperditions de l’enveloppe GV
 */
final class Deperdition
{
    private EnveloppeEngine $context;

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
        return $this->context->deperdition_ventilation()?->dr() ?? 0;
    }

    /**
     * PT - Déperditions thermiques par les ponts thermiques (W/K)
     */
    public function pt(): float
    {
        return $this->context->pont_thermique_engine()->deperdition_thermique()->pt();
    }

    /**
     * DP - Déperditions thermiques par les parois (W/K)
     */
    public function dp(): float
    {
        return \array_sum([
            $this->context->mur_engine()->deperdition_thermique()->dp(),
            $this->context->plancher_haut_engine()->deperdition_thermique()->dp(),
            $this->context->plancher_bas_engine()->deperdition_thermique()->dp(),
            $this->context->porte_engine()->deperdition_thermique()->dp(),
        ]);
    }

    /**
     * sdep - Surface déperditive de l'enveloppe (m²)
     */
    public function sdep(): float
    {
        return \array_sum([
            $this->context->mur_engine()->deperdition_thermique()->sdep(),
            $this->context->plancher_haut_engine()->deperdition_thermique()->sdep(),
            $this->context->plancher_bas_engine()->deperdition_thermique()->sdep(),
            $this->context->porte_engine()->deperdition_thermique()->sdep(),
        ]);
    }

    /**
     * Indicateur de performance de l'enveloppe
     */
    public function qualite_isolation(): ?QualiteComposant
    {
        return ($ubat = $this->ubat()) ? QualiteComposant::from_ubat($ubat) : null;
    }

    public function __invoke(EnveloppeEngine $context): self
    {
        $this->context = $context;
        return $this;
    }
}
