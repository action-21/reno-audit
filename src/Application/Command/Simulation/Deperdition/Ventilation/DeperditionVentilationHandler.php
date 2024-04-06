<?php

namespace App\Command\Simulation\Deperdition\Ventilation;

use App\Domain\Common\Enum\Situation\{PeriodeConstruction, TypeBatiment};
use App\Domain\Common\Enum\Ventilation\{ConfigurationExposition, TypeVentilation};
use App\Domain\Moteur3CL\Deperdition\Ventilation\DeperditionVentilation;
use App\Domain\Moteur3CL\Deperdition\Ventilation\Table\{DebitRepository, Q4paConvRepository};

final class DeperditionVentilationHandler
{
    use DeperditionVentilation;

    private DeperditionVentilationCommand $command;

    public function __construct(
        private DebitRepository $table_debit_repository,
        private Q4paConvRepository $table_q4pa_conv_repository,
    ) {
    }

    /** @inheritdoc */
    public function surface_habitable(): float
    {
        return $this->command->surface_habitable;
    }

    /** @inheritdoc */
    public function hsp(): float
    {
        return $this->command->hsp;
    }

    /** @inheritdoc */
    public function sdep(): float
    {
        return $this->command->sdep;
    }

    /** @inheritdoc */
    public function volume(): float
    {
        return $this->command->volume;
    }

    /** @inheritdoc */
    public function presence_joint(): bool
    {
        return $this->command->presence_joint;
    }

    /** @inheritdoc */
    public function isolation_murs_plafonds(): bool
    {
        return $this->command->isolation_murs_plafonds;
    }

    /** @inheritdoc */
    public function q4pa_conv_saisi(): ?float
    {
        return $this->command->q4pa_conv_saisi;
    }

    /** @inheritdoc */
    public function type_batiment(): TypeBatiment
    {
        return $this->command->type_batiment;
    }

    /** @inheritdoc */
    public function periode_construction(): PeriodeConstruction
    {
        return $this->command->periode_construction;
    }

    /** @inheritdoc */
    public function type_ventilation(): TypeVentilation
    {
        return $this->command->type_ventilation;
    }

    /** @inheritdoc */
    public function exposition(): ConfigurationExposition
    {
        return $this->command->exposition;
    }

    public function __invoke(DeperditionVentilationCommand $command): DeperditionVentilation
    {
        $this->command = $command;

        return $this;
    }
}
