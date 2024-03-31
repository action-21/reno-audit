<?php

namespace App\Domain\Moteur3CL\Ecs\Rendement\Table;

final class RendementDistribution
{
    public function __construct(
        public readonly int $id,
        public readonly float $rd,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function rd(): float
    {
        return $this->rd;
    }
}
