<?php

namespace App\Domain\PlancherHaut\ValueObject;

use App\Domain\PlancherHaut\Enum\TypePlancherHaut;

final class Caracteristique
{
    public function __construct(
        public readonly float $surface,
        public readonly bool $paroi_lourde,
        public readonly TypePlancherHaut $type_plancher_haut,
    ) {
    }
}
