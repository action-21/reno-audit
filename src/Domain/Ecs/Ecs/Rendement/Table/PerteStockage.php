<?php

namespace App\Domain\Moteur3CL\Ecs\Rendement\Table;

final class PerteStockage
{
    public function __construct(
        public readonly int $id,
        public readonly float $cr,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function cr(): float
    {
        return $this->cr;
    }
}
