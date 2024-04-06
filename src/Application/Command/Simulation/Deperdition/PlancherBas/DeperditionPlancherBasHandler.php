<?php

namespace App\Command\Simulation\Deperdition\PlancherBas;

use App\Domain\Common\Enum\Isolation\{PeriodeIsolation, TypeIsolation};
use App\Domain\Common\Enum\Paroi\TypeAdjacence;
use App\Domain\Common\Enum\PlancherBas\TypePlancherBas;
use App\Domain\Common\Enum\Situation\{PeriodeConstruction, ZoneClimatique};
use App\Domain\Moteur3CL\Deperdition\Paroi\Table\CoefficientReductionDeperditionRepository;
use App\Domain\Moteur3CL\Deperdition\Paroi\Table\CoefficientReductionDeperditionVerandaRepository;
use App\Domain\Moteur3CL\Deperdition\Paroi\Table\UvueRepository;
use App\Domain\Moteur3CL\Deperdition\PlancherBas\DeperditionPlancherBas;
use App\Domain\Moteur3CL\Deperdition\PlancherBas\Table\{UpbRepository, Upb0Repository, UeRepository};

final class DeperditionPlancherBasHandler
{
    use DeperditionPlancherBas;

    private DeperditionPlancherBasCommand $command;

    public function __construct(
        private UvueRepository $table_uvue_repository,
        private CoefficientReductionDeperditionRepository $table_b_repository,
        private CoefficientReductionDeperditionVerandaRepository $table_bver_repository,
        private Upb0Repository $table_upb0_repository,
        private UpbRepository $table_upb_repository,
        private UeRepository $table_ue_repository,
    ) {
    }

    /** @inheritdoc */
    public function perimetre(): float
    {
        return $this->command->perimetre;
    }

    /** @inheritdoc */
    public function surface(): float
    {
        return $this->command->surface;
    }

    /** @inheritdoc */
    public function surface_pleine(): float
    {
        return $this->command->surface_pleine;
    }

    /** @inheritdoc */
    public function upb_saisi(): ?float
    {
        return $this->command->upb_saisi;
    }

    /** @inheritdoc */
    public function upb0_saisi(): ?float
    {
        return $this->command->upb0_saisi;
    }

    /** @inheritdoc */
    public function resistance_isolation(): ?float
    {
        return $this->command->resistance_isolation;
    }

    /** @inheritdoc */
    public function epaisseur_isolation(): ?float
    {
        return $this->command->epaisseur_isolation;
    }

    /** @inheritdoc */
    public function effet_joule(): bool
    {
        return $this->command->effet_joule;
    }

    /** @inheritdoc */
    public function type_plancher_bas(): TypePlancherBas
    {
        return $this->command->type_plancher_bas;
    }

    /** @inheritdoc */
    public function periode_construction(): PeriodeConstruction
    {
        return $this->command->periode_construction;
    }

    /** @inheritdoc */
    public function periode_construction_isolation(): PeriodeConstruction|PeriodeIsolation
    {
        return $this->command->periode_construction_isolation;
    }

    /** @inheritdoc */
    public function type_isolation(): TypeIsolation
    {
        return $this->command->type_isolation;
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

    public function __invoke(DeperditionPlancherBasCommand $command): DeperditionPlancherBas
    {
        $this->command = $command;

        return $this;
    }
}
