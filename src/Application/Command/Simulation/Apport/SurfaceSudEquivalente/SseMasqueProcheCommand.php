<?php

namespace App\Command\Simulation\Apport\SurfaceSudEquivalente;

use App\Domain\Audit\Baie\MasqueProche;
use App\Domain\Common\Enum\Masque\{Orientation, TypeMasqueProche};

final class SseMasqueProcheCommand
{
    public function __construct(
        public readonly float $avancee,
        public readonly TypeMasqueProche $type_masque,
        public readonly Orientation $orientation,
    ) {
    }

    public static function from(MasqueProche $entity,): self
    {
        return new self(
            avancee: $entity->avancee(),
            type_masque: $entity->type_masque_proche(),
            orientation: $entity->orientation(),
        );
    }
}
