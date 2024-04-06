<?php

namespace App\Domain\Lnc\Engine;

use App\Domain\Lnc\Lnc;
use App\Domain\Lnc\Table\{CoefficientReductionDeperdition, CoefficientReductionDeperditionRepository};
use App\Domain\Lnc\Table\{CoefficientReductionDeperditionVerandaCollection, CoefficientReductionDeperditionVerandaRepository};

/**
 * @see §3.1 Détermination du coefficient de réduction des déperditions b
 */
final class ReductionDeperdition
{
    private Lnc $input;
    private ?CoefficientReductionDeperdition $table_b = null;
    private ?CoefficientReductionDeperditionVerandaCollection $table_bver_collection = null;

    public function __construct(
        private CoefficientReductionDeperditionRepository $table_b_repository,
        private CoefficientReductionDeperditionVerandaRepository $table_bver_repository,
    ) {
    }

    /**
     * Coefficient de réduction des déperditions thermiques des parois donnant sur un local non chauffé
     */
    public function b(): float
    {
        if ($this->input->ets()) {
            return $this->table_bver_collection()
                ->search_by_orientation_collectionn($this->input->baie_collection()->orientations())
                ->bver();
        }
        return $this->table_b()?->b() ?? 1;
    }

    public function table_b(): ?CoefficientReductionDeperdition
    {
        return $this->table_b;
    }

    public function table_bver_collection(): CoefficientReductionDeperditionVerandaCollection
    {
        return $this->table_bver_collection;
    }

    public function input(): Lnc
    {
        return $this->input;
    }

    public function __invoke(Lnc $input): self
    {
        $this->input = $input;

        $this->table_b = false === $input->ets() ? $this->table_b_repository->find(
            type_lnc: $this->input->type_lnc(),
            isolation_aiu: $this->input->isolation_aiu(),
            isolation_aue: $this->input->isolation_aue(),
            surface_aiu: $this->input->surface_aiu(),
            surface_aue: $this->input->surface_aue(),
        ) : null;

        $this->table_bver_collection = $input->ets() ? $this->table_bver_repository->search(
            zone_climatique: $this->input->enveloppe()->batiment()->adresse()->zone_climatique,
            isolation_aiu: $this->input->isolation_aiu(),
        ) : new CoefficientReductionDeperditionVerandaCollection;

        return $this;
    }
}
