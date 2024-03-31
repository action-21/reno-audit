<?php

namespace App\Command\Simulation\Apport;

use App\Command\Simulation\Apport\SurfaceSudEquivalente\SseBaieCommand;
use App\Command\Simulation\Apport\SurfaceSudEquivalente\SseBaieHandler;
use App\Domain\Common\Enum\Inertie\ClasseInertie;
use App\Domain\Common\Enum\Situation\{ClasseAltitude, ZoneClimatique};
use App\Domain\Moteur3CL\Apport\Apport;
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\{SseBaie, SseBaieCollection};
use App\Domain\Moteur3CL\Situation\Table\{SollicitationExterieureRepository, TbaseRepository};

final class ApportHandler
{
    use Apport;

    private ApportCommand $command;

    public function __construct(
        private SseBaieHandler $sse_baie_handler,
        private SollicitationExterieureRepository $table_ext_repository,
        private TbaseRepository $table_tbase_repository,
    ) {
    }

    /** @inheritdoc */
    public function surface_habitable(): float
    {
        return $this->command->surface_habitable;
    }

    /** @inheritdoc */
    public function classe_inertie(): ClasseInertie
    {
        return $this->command->classe_inertie;
    }

    /** @inheritdoc */
    public function gv(): float
    {
        return $this->command->gv;
    }

    /** @inheritdoc */
    public function nadeq(): float
    {
        return $this->command->nadeq;
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

    /** @inheritdoc */
    public function baie_collection(): SseBaieCollection
    {
        return $this->has('baie_collection')
            ? $this->get('baie_collection')
            : $this->set('baie_collection', new SseBaieCollection(\array_map(
                fn (SseBaieCommand $item): SseBaie => ($this->sse_baie_handler)($item),
                $this->command->baie_collection,
            )));
    }

    public function __invoke(ApportCommand $command): self
    {
        $this->command = $command;

        return $this;
    }
}
