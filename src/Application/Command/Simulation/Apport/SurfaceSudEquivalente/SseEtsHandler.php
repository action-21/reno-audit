<?php

namespace App\Command\Simulation\Apport\SurfaceSudEquivalente;

use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\{SseEts, SseEtsBaie, SseEtsBaieCollection};
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\Table\{Fe2Repository, OmbRepository};

final class SseEtsHandler
{
    use SseEts;

    private SseEtsCommand $command;

    public function __construct(
        private SseEtsBaie $sse_ets_baie,
        private Fe2Repository $table_fe2_repository,
        private OmbRepository $table_omb_repository,
    ) {
    }

    /** @inheritdoc */
    public function ets_baie_collection(): float
    {
        return $this->has('ets_baie_collection')
            ? $this->get('ets_baie_collection')
            : $this->set('ets_baie_collection', new SseEtsBaieCollection(\array_map(
                fn (SseEtsBaieCommand $item): SseEtsBaie => ($this->sse_ets_baie)($item),
                $this->command->ets_baie_collection,
            )));
    }

    public function __invoke(SseEtsCommand $command): self
    {
        $this->command = $command;

        return $this;
    }
}
