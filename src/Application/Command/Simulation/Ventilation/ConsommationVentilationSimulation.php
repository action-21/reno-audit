<?php

namespace App\Command\Simulation\Ventilation;

use App\Domain\Common\Enum\Situation\TypeBatiment;
use App\Domain\Common\Enum\Ventilation\TypeVentilation;
use App\Domain\Moteur3CL\Ventilation\ConsommationVentilation;
use App\Domain\Moteur3CL\Ventilation\Table\DebitRepository;

final class ConsommationVentilationSimulation
{
    use ConsommationVentilation;

    private ConsommationVentilationCommand $command;

    public function __construct(
        private DebitRepository $table_debit_repository,
    ) {
    }

    /** @inheritdoc */
    public function surface_habitable(): float
    {
        return $this->command->surface_habitable;
    }

    /** @inheritdoc */
    public function q4pa_conv(): ?float
    {
        return $this->command->q4pa_conv;
    }

    /** @inheritdoc */
    public function type_batiment(): TypeBatiment
    {
        return $this->command->type_batiment;
    }

    /** @inheritdoc */
    public function type_ventilation(): TypeVentilation
    {
        return $this->command->type_ventilation;
    }

    public function __invoke(ConsommationVentilationCommand $command): self
    {
        $this->command = $command;

        return $this;
    }
}
