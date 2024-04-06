<?php

namespace App\Command\Simulation\Eclairage;

use App\Domain\Common\Enum\Situation\ZoneClimatique;
use App\Domain\Moteur3CL\Eclairage\Eclairage;
use App\Domain\Moteur3CL\Eclairage\Table\NheclRepository;

final class EclairageHandler
{
    use Eclairage;

    private EclairageCommand $command;

    public function __construct(private NheclRepository $table_nh_repository)
    {
    }

    /** @inheritdoc */
    public function surface_habitable_moyenne(): float
    {
        return $this->command->surface_habitable_moyenne;
    }

    /** @inheritdoc */
    public function zone_climatique(): ZoneClimatique
    {
        return $this->command->zone_climatique;
    }

    public function __invoke(EclairageCommand $command): self
    {
        $this->command = $command;

        return $this;
    }
}
