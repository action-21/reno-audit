<?php

namespace App\Domain\Mur\Engine;

use App\Domain\Batiment\BatimentEngine;
use App\Domain\Mur\Mur;
use App\Domain\Mur\Table\{Umur, UmurRepository, Umur0Collection, Umur0Repository};
use App\Domain\Paroi\Engine\DeperditionParoi;
use App\Domain\Paroi\Enum\QualiteComposant;

/**
 * @see §3.2.1
 */
final class DeperditionMur
{
    use DeperditionParoi;

    /**
     * Lambda par défaut des murs isolés
     */
    final public const LAMBDA_MUR_DEFAUT = 0.04;

    /**
     * Résistance additionnelle dûe à la présence d'un enduit sur une paroi ancienne
     */
    final public const RESISTANCE_ENDUIT_PAROI_ANCIENNE = 0.7;

    private Mur $input;
    private ?Umur0Collection $table_umur0_collection = null;
    private ?Umur $table_umur = null;

    public function __construct(
        private Umur0Repository $table_umur0_repository,
        private UmurRepository $table_umur_repository,
    ) {
    }

    /**
     * DP,mur - Déperditions thermiques (W/K)
     */
    public function dp(): float
    {
        return $this->u() * $this->sdep() * $this->b();
    }

    /**
     * u,mur - Coefficient de transmission thermique (W/(m².K))
     */
    public function u(): ?float
    {
        if ($this->input->performance_isolation()->u_saisi) {
            return $this->input->performance_isolation()->u_saisi;
        }
        if ($this->input->type_isolation()->inconnu()) {
            return \min($this->u0(), $this->table_umur()?->umur());
        }
        if (false === $this->input->est_isole()) {
            return $this->u0();
        }
        if ($this->input->est_isole() && null !== $this->input->performance_isolation()->resistance_isolation) {
            return 1 / (1 / $this->u0() + $this->input->performance_isolation()->resistance_isolation);
        }
        if ($this->input->est_isole() && $this->input->performance_isolation()->epaisseur_isolation) {
            return 1 / (1 / $this->u0() + $this->input->performance_isolation()->epaisseur_isolation / 100 / self::LAMBDA_MUR_DEFAUT);
        }
        return \min($this->u0(), $this->table_umur()?->umur());
    }

    /**
     * u0,mur - Coefficient de transmission thermique de la paroi nue (W/(m².K))
     */
    public function u0(): ?float
    {
        return $this->input->performance()->u0_saisi ?? $this->table_umur0_collection()->umur0(
            epaisseur_structure: $this->input->caracteristique()->epaisseur_structure,
        );
    }

    /**
     * Surface déperditive (m²)
     */
    public function sdep(): float
    {
        return $this->input->surface_pleine();
    }

    /**
     * Résistance thermique additionnelle du doublage (m2.K/W)
     */
    public function resistance_doublage(): float
    {
        return $this->input->caracteristique()->type_doublage->resistance_doublage();
    }

    /**
     * Résistance thermique additionnelle des parois anciennes (m2. K/W)
     */
    public function resistance_paroi_ancienne(): float
    {
        return $this->input->caracteristique()->enduit_isolant_paroi_ancienne ? self::RESISTANCE_ENDUIT_PAROI_ANCIENNE : 0;
    }

    /**
     * Indicateur de performance de l'élément
     */
    public function qualite_isolation(): ?QualiteComposant
    {
        return ($u = $this->u()) ? QualiteComposant::from_umur($u) : null;
    }

    public function table_umur(): ?Umur
    {
        return $this->table_umur;
    }

    public function table_umur0_collection(): Umur0Collection
    {
        return $this->table_umur0_collection;
    }

    public function input(): Mur
    {
        return $this->input;
    }

    public function __invoke(Mur $input, BatimentEngine $context): self
    {
        $this->input = $input;
        $this->context = $context;

        $this->table_umur0_collection = $this->table_umur0_repository->search(
            materiaux_structure: $this->input->caracteristique()->materiaux_structure,
        );
        $this->table_umur = $this->table_umur_repository->find(
            zone_climatique: $this->input->batiment()->adresse()->zone_climatique,
            periode_construction_isolation: $this->input->periode_construction_isolation(),
            effet_joule: $this->input->batiment()->effet_joule(),
        );

        return $this;
    }
}
