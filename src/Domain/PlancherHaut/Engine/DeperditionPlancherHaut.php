<?php

namespace App\Domain\PlancherHaut\Engine;

use App\Domain\Batiment\BatimentEngine;
use App\Domain\Paroi\Engine\DeperditionParoi;
use App\Domain\Paroi\Enum\QualiteComposant;
use App\Domain\PlancherHaut\PlancherHaut;
use App\Domain\PlancherHaut\Table\{Uph, Uph0, UphRepository, Uph0Repository};

/**
 * @see §3.2.3
 * 
 */
final class DeperditionPlancherHaut
{
    use DeperditionParoi;

    /**
     * Lambda par défaut des planchers hauts isolés
     */
    final public const LAMBDA_PLANCHER_HAUT_DEFAUT = 0.04;

    private PlancherHaut $input;
    private ?Uph0 $table_uph0 = null;
    private ?Uph $table_uph = null;

    public function __construct(
        private Uph0Repository $table_uph0_repository,
        private UphRepository $table_uph_repository,
    ) {
    }

    /**
     * DP,ph - Déperditions thermiques (W/K)
     */
    public function dp(): float
    {
        return $this->u() * $this->sdep() * $this->b();
    }

    /**
     * u,ph - Coefficient de transmission thermique (W/(m².K))
     */
    public function u(): ?float
    {
        if ($this->input->performance_isolation()->u_saisi) {
            return $this->input->performance_isolation()->u_saisi;
        }
        if ($this->input->type_isolation()->inconnu()) {
            return \min($this->u0(), $this->table_uph()?->uph());
        }
        if (false === $this->input->est_isole()) {
            return $this->u0();
        }
        if ($this->input->performance_isolation()->resistance_isolation) {
            return 1 / (1 / $this->u0() + $this->input->performance_isolation()->resistance_isolation);
        }
        if ($this->input->performance_isolation()->epaisseur_isolation) {
            return 1 / (1 / $this->u0() + $this->input->performance_isolation()->epaisseur_isolation / 100 / self::LAMBDA_PLANCHER_HAUT_DEFAUT);
        }
        return \min($this->u0(), $this->table_uph()?->uph());
    }

    /**
     * u0,ph - Coefficient de transmission thermique de la paroi nue (W/(m².K))
     */
    public function u0(): ?float
    {
        return $this->input->performance()->u0_saisi ?? $this->table_uph0()?->uph0();
    }

    /**
     * Surface déperditive (m²)
     */
    public function sdep(): float
    {
        return $this->input->surface_pleine();
    }

    /**
     * Indicateur de performance de l'élément
     */
    public function qualite_isolation(): ?QualiteComposant
    {
        return ($u = $this->u()) ? QualiteComposant::from_uph($u) : null;
    }

    public function table_uph(): ?Uph
    {
        return $this->table_uph;
    }

    public function table_uph0(): ?Uph0
    {
        return $this->table_uph0;
    }

    public function input(): PlancherHaut
    {
        return $this->input;
    }

    public function __invoke(PlancherHaut $input, BatimentEngine $context): self
    {
        $this->input = $input;
        $this->context = $context;

        $this->table_uph0 = $this->table_uph0_repository->find(
            type_plancher_haut: $this->input->caracteristique()->type_plancher_haut
        );

        $this->table_uph = $this->table_uph_repository->find(
            zone_climatique: $this->input->batiment()->adresse()->zone_climatique,
            periode_construction_isolation: $this->input->periode_construction_isolation(),
            configuration_plancher_haut: $this->input->configuration_plancher_haut(),
            effet_joule: $this->input->batiment()->effet_joule(),
        );

        return $this;
    }
}
