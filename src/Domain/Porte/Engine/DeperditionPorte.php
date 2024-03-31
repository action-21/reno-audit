<?php

namespace App\Domain\Porte\Engine;

use App\Domain\Batiment\BatimentEngine;
use App\Domain\Paroi\Engine\DeperditionParoi;
use App\Domain\Paroi\Enum\QualiteComposant;
use App\Domain\Porte\Table\{Uporte, UporteRepository};
use App\Domain\Porte\Porte;

/**
 * @see §3.3.4
 */
final class DeperditionPorte
{
    use DeperditionParoi;

    private Porte $input;
    private ?Uporte $table_uporte = null;

    public function __construct(
        private UporteRepository $table_uporte_repository,
    ) {
    }

    /**
     * DP,porte - Déperditions thermiques (W/K)
     */
    public function dp(): float
    {
        return $this->u() * $this->sdep() * $this->b();
    }

    /**
     * u,porte - Coefficient de transmission thermique (W/(m².K))
     */
    public function u(): ?float
    {
        return $this->input->performance()->uporte_saisi ?? $this->table_uporte()?->uporte();
    }

    /**
     * Surface déperditive (m²)
     */
    public function sdep(): float
    {
        return $this->input->caracteristique()->surface;
    }

    /**
     * Indicateur de performance de l'élément
     */
    public function qualite_isolation(): ?QualiteComposant
    {
        return ($u = $this->u()) ? QualiteComposant::from_uporte($u) : null;
    }

    public function table_uporte(): ?Uporte
    {
        return $this->table_uporte;
    }

    public function input(): Porte
    {
        return $this->input;
    }

    public function __invoke(Porte $input, BatimentEngine $context): self
    {
        $this->input = $input;
        $this->context = $context;
        $this->table_uporte = $this->table_uporte_repository->find(type_porte: $this->input->caracteristique()->type_porte);

        return $this;
    }
}
