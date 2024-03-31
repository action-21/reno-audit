<?php

namespace App\Domain\PlancherBas\Engine;

use App\Domain\Batiment\BatimentEngine;
use App\Domain\Paroi\Engine\DeperditionParoi;
use App\Domain\Paroi\Enum\QualiteComposant;
use App\Domain\PlancherBas\PlancherBas;
use App\Domain\PlancherBas\Table\{Upb, UpbRepository, Upb0, Upb0Repository, UeCollection, UeRepository};

/**
 * @see §3.2.2
 */
final class DeperditionPlancherBas
{
    use DeperditionParoi;

    /**
     * Lambda par défaut des planchers bas isolés
     */
    final public const LAMBDA_PLANCHER_BAS_DEFAUT = 0.042;

    private PlancherBas $input;
    private ?Upb0 $table_upb0 = null;
    private ?Upb $table_upb = null;
    private ?UeCollection $table_ue_collection = null;

    public function __construct(
        private Upb0Repository $table_upb0_repository,
        private UpbRepository $table_upb_repository,
        private UeRepository $table_ue_repository,
    ) {
    }

    /**
     * DP,pb - Déperditions thermiques (W/K)
     */
    public function dp(): float
    {
        return $this->ufinal() * $this->sdep() * $this->b();
    }

    /**
     * u,pb,final - Coefficient de transmission thermique final (W/(m².K))
     */
    public function ufinal(): ?float
    {
        return $this->calcul_ue() ? $this->ue() : $this->u();
    }

    /**
     * u,pb - Coefficient de transmission thermique (W/(m².K))
     */
    public function u(): ?float
    {
        if ($this->input->performance_isolation()->u_saisi) {
            return $this->input->performance_isolation()->u_saisi;
        }
        if ($this->input->type_isolation()->inconnu()) {
            return \min($this->u0(), $this->table_upb()?->upb());
        }
        if (false === $this->input->est_isole()) {
            return $this->u0();
        }
        if ($this->input->performance_isolation()->resistance_isolation) {
            return 1 / (1 / $this->u0() + $this->input->performance_isolation()->resistance_isolation);
        }
        if ($this->input->performance_isolation()->epaisseur_isolation) {
            return 1 / (1 / $this->u0() + $this->input->performance_isolation()->epaisseur_isolation / 100 / self::LAMBDA_PLANCHER_BAS_DEFAUT);
        }
        return \min($this->u0(), $this->table_upb()?->upb());
    }

    /**
     * u0,pb - Coefficient de transmission thermique de la paroi nue (W/(m².K))
     */
    public function u0(): ?float
    {
        return $this->input->performance()->u0_saisi ?? $this->table_upb0()?->upb0();
    }

    /**
     * ue,ph - Coefficient de transmission thermique du plancher bas sur terre-plain, sous-sol non chauffé et vide sanitaire (W/m².K)
     */
    public function ue(): ?float
    {
        return ($upb = $this->u()) ? $this->table_ue_collection()->ue(
            upb: $upb,
            surface: $this->input->caracteristique()->surface,
            perimetre: $this->input->caracteristique()->perimetre,
        ) : null;
    }

    /**
     * Prise en compte de ue pour le calcul de u
     */
    public function calcul_ue(): bool
    {
        return $this->input->mitoyennete()->terre_plein() || $this->input->mitoyennete()->vide_sanitaire();
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
        return ($u = $this->u()) ? QualiteComposant::from_upb($u) : null;
    }

    /**
     * Valeurs de la table ue
     */
    public function table_ue_collection(): UeCollection
    {
        return $this->table_ue_collection;
    }

    /**
     * Valeur de la table upb
     */
    public function table_upb(): ?Upb
    {
        return $this->table_upb;
    }

    /**
     * Valeur de la table upb0
     */
    public function table_upb0(): ?Upb0
    {
        return $this->table_upb0;
    }

    public function input(): PlancherBas
    {
        return $this->input;
    }

    public function __invoke(PlancherBas $input, BatimentEngine $context): self
    {
        $this->input = $input;
        $this->context = $context;

        $this->table_upb0 = $this->table_upb0_repository->find(
            type_plancher_bas: $this->input->caracteristique()->type_plancher_bas
        );
        $this->table_upb = $this->table_upb_repository->find(
            zone_climatique: $this->input->batiment()->adresse()->zone_climatique,
            periode_construction_isolation: $this->input->periode_construction_isolation(),
            effet_joule: $this->input->batiment()->effet_joule(),
        );
        $this->table_ue_collection = $this->table_ue_repository->search(
            mitoyennete: $this->input->mitoyennete(),
            periode_construction: $this->input->batiment()->caracteristique()->periode_construction,
        );

        return $this;
    }
}
