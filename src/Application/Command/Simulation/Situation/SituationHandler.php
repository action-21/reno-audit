<?php

namespace App\Command\Simulation\Situation;

use App\Domain\Common\Enum\Situation\{ClasseAltitude, ZoneClimatique};
use App\Domain\Moteur3CL\Situation\Situation;
use App\Domain\Moteur3CL\Situation\Table\{SollicitationExterieureRepository, TbaseRepository};

final class SituationHandler
{
    use Situation;

    private SituationCommand $command;

    public function __construct(
        private SollicitationExterieureRepository $table_ext_repository,
        private TbaseRepository $table_tbase_repository,
    ) {
    }

    /** @inheritdoc */
    public function parois_anciennes_lourdes(): bool
    {
        return $this->command->parois_anciennes_lourdes;
    }

    /** @inheritdoc */
    public function classe_altitude(): ClasseAltitude
    {
        return $this->command->classe_altitude;
    }

    /** @inheritdoc */
    public function zone_climatique(): ZoneClimatique
    {
        return $this->command->zone_climatique;
    }

    public function __invoke(SituationCommand $command): self
    {
        $this->command = $command;

        return $this;
    }
}
