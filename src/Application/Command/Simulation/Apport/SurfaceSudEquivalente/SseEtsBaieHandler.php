<?php

namespace App\Command\Simulation\Apport\SurfaceSudEquivalente;

use App\Domain\Common\Enum\Menuiserie\MateriauxMenuiserie;
use App\Domain\Common\Enum\Paroi\Orientation;
use App\Domain\Common\Enum\Situation\ZoneClimatique;
use App\Domain\Common\Enum\Vitrage\{InclinaisonVitrage, TypeVitrage};
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\SseEtsBaie;
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\Table\{Fe2Repository, OmbRepository};

final class SseEtsBaieHandler
{
    use SseEtsBaie;

    private SseEtsBaieCommand $command;

    public function __construct(
        private Fe2Repository $table_fe2_repository,
        private OmbRepository $table_omb_repository,
    ) {
    }

    /** @inheritdoc */
    public function surface(): float
    {
        return $this->command->surface;
    }

    /** @inheritdoc */
    public function vitrage_vir(): bool
    {
        return $this->command->vitrage_vir;
    }

    /** @inheritdoc */
    public function zone_climatique(): ZoneClimatique
    {
        return $this->command->zone_climatique;
    }

    /** @inheritdoc */
    public function orientation(): Orientation
    {
        return $this->command->orientation;
    }

    /** @inheritdoc */
    public function type_materiaux_menuiserie(): MateriauxMenuiserie
    {
        return $this->command->type_materiaux_menuiserie;
    }

    /** @inheritdoc */
    public function type_vitrage(): TypeVitrage
    {
        return $this->command->type_vitrage;
    }

    /** @inheritdoc */
    public function inclinaison_vitrage(): InclinaisonVitrage
    {
        return $this->command->inclinaison_vitrage;
    }

    public function __invoke(SseEtsBaieCommand $command): self
    {
        $this->command = $command;

        return $this;
    }
}
