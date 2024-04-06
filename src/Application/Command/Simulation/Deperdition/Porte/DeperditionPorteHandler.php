<?php

namespace App\Command\Simulation\Deperdition\Porte;

use App\Domain\Common\Enum\Paroi\TypeAdjacence;
use App\Domain\Common\Enum\Porte\TypePorte;
use App\Domain\Common\Enum\Situation\ZoneClimatique;
use App\Domain\Moteur3CL\Deperdition\Porte\DeperditionPorte;
use App\Domain\Moteur3CL\Deperdition\Porte\Table\UporteRepository;
use App\Domain\Moteur3CL\Deperdition\Paroi\Table\CoefficientReductionDeperditionRepository;
use App\Domain\Moteur3CL\Deperdition\Paroi\Table\CoefficientReductionDeperditionVerandaRepository;
use App\Domain\Moteur3CL\Deperdition\Paroi\Table\UvueRepository;

final class DeperditionPorteHandler
{
    use DeperditionPorte;

    private DeperditionPorteCommand $command;

    public function __construct(
        private UvueRepository $table_uvue_repository,
        private CoefficientReductionDeperditionRepository $table_b_repository,
        private CoefficientReductionDeperditionVerandaRepository $table_bver_repository,
        private UporteRepository $table_uporte_repository,
    ) {
    }

    /** @inheritdoc */
    public function surface(): float
    {
        return $this->command->surface;
    }

    /** @inheritdoc */
    public function uporte_saisi(): ?float
    {
        return $this->command->uporte;
    }

    /** @inheritdoc */
    public function type_porte(): TypePorte
    {
        return $this->command->type_porte;
    }

    /** @inheritdoc */
    public function surface_aiu(): ?float
    {
        return $this->command->surface_aiu;
    }

    /** @inheritdoc */
    public function surface_aue(): ?float
    {
        return $this->command->surface_aue;
    }

    /** @inheritdoc */
    public function isolation_aiu(): ?bool
    {
        return $this->command->isolation_aiu;
    }

    /** @inheritdoc */
    public function isolation_aue(): ?bool
    {
        return $this->command->isolation_aue;
    }

    /** @inheritdoc */
    public function isolation(): bool
    {
        return $this->command->isolation;
    }

    /** @inheritdoc */
    public function adjacence_ets(): bool
    {
        return $this->command->adjacence_ets;
    }

    /** @inheritdoc */
    public function orientation_ets_collection(): array
    {
        return $this->command->orientation_ets_collection;
    }

    /** @inheritdoc */
    public function zone_climatique(): ZoneClimatique
    {
        return $this->command->zone_climatique;
    }

    /** @inheritdoc */
    public function type_adjacence(): TypeAdjacence
    {
        return $this->command->type_adjacence;
    }

    public function __invoke(DeperditionPorteCommand $command): DeperditionPorte
    {
        $this->command = $command;

        return $this;
    }
}
