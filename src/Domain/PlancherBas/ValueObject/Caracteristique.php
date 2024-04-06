<?php

namespace App\Domain\PlancherBas\ValueObject;

use App\Domain\PlancherBas\Enum\TypePlancherBas;

/**
 * Caractéristiques d'un plancher bas
 */
final class Caracteristique
{
    public function __construct(
        public readonly float $surface,
        public readonly float $perimetre,
        public readonly bool $paroi_lourde,
        public readonly TypePlancherBas $type_plancher_bas,
    ) {
    }
}
