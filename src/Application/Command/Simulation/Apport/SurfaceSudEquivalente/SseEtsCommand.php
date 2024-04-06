<?php

namespace App\Command\Simulation\Apport\SurfaceSudEquivalente;

use App\Domain\Audit\Lnc\EtsBaie;
use App\Domain\Audit\Lnc\Lnc;

/**
 * @property SseEtsBaieCommand[] $ets_baie_collection
 */
final class SseEtsCommand
{
    public function __construct(
        public readonly array $ets_baie_collection,
    ) {
    }

    public static function from(Lnc $entity): self
    {
        return new self(ets_baie_collection: \array_map(
            fn (EtsBaie $item): SseEtsBaieCommand => SseEtsBaieCommand::from($item),
            $entity->ets_baie_collection()->values(),
        ));
    }
}
