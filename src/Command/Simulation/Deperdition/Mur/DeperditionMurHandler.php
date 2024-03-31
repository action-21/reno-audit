<?php

namespace App\Command\Simulation\Deperdition\Mur;

use App\Domain\Common\Enum\Isolation\{PeriodeIsolation, TypeIsolation};
use App\Domain\Common\Enum\Paroi\TypeAdjacence;
use App\Domain\Common\Enum\Mur\{MateriauxStructure, TypeDoublage};
use App\Domain\Common\Enum\Situation\{PeriodeConstruction, ZoneClimatique};
use App\Domain\Moteur3CL\Deperdition\Paroi\Table\CoefficientReductionDeperditionRepository;
use App\Domain\Moteur3CL\Deperdition\Paroi\Table\CoefficientReductionDeperditionVerandaRepository;
use App\Domain\Moteur3CL\Deperdition\Paroi\Table\UvueRepository;
use App\Domain\Moteur3CL\Deperdition\Mur\Table\{UmurRepository, Umur0Repository};
use App\Domain\Moteur3CL\Deperdition\Mur\DeperditionMur;

final class DeperditionMurHandler
{
    use DeperditionMur;

    private DeperditionMurCommand $command;

    public function __construct(
        private UvueRepository $table_uvue_repository,
        private CoefficientReductionDeperditionRepository $table_b_repository,
        private CoefficientReductionDeperditionVerandaRepository $table_bver_repository,
        private Umur0Repository $table_umur0_repository,
        private UmurRepository $table_umur_repository,
    ) {
    }

    /** @inheritdoc */
    public function surface_pleine(): float
    {
        return $this->command->surface_pleine;
    }

    /** @inheritdoc */
    public function umur_saisi(): ?float
    {
        return $this->command->umur_saisi;
    }

    /** @inheritdoc */
    public function umur0_saisi(): ?float
    {
        return $this->command->umur0_saisi;
    }

    /** @inheritdoc */
    public function epaisseur_structure(): float
    {
        return $this->command->epaisseur_structure;
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
    public function enduit_isolant_paroi_ancienne(): bool
    {
        return $this->command->enduit_isolant_paroi_ancienne;
    }

    /** @inheritdoc */
    public function materiaux_structure(): MateriauxStructure
    {
        return $this->command->materiaux_structure;
    }

    /** @inheritdoc */
    public function type_doublage(): TypeDoublage
    {
        return $this->command->type_doublage;
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

    public function __invoke(DeperditionMurCommand $command): DeperditionMur
    {
        $this->command = $command;

        return $this;
    }
}
