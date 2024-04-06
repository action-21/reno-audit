<?php

namespace App\Domain\PlancherBas\Table;

use App\Domain\Common\Table\TableValue;

/**
 * Valeur forfaitaire du coefficient de transmission thermique d'un plancher bas sur terre plein
 */
final class Ue implements TableValue
{
    public function __construct(
        public readonly int $id,
        public readonly float $x,
        public readonly float $y,
        public readonly float $ue,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    /**
     * x = upb
     */
    public function x(): float
    {
        return $this->x;
    }

    /**
     * y = 2S/P
     */
    public function y(): float
    {
        return $this->y;
    }

    public function ue(): float
    {
        return $this->ue;
    }
}
