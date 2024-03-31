<?php

namespace App\Domain\Baie\Table;

use App\Domain\Common\Table\TableValue;

class Uw implements TableValue
{
    public function __construct(
        public readonly int $id,
        public readonly ?float $ug,
        public readonly float $uw,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function ug(): ?float
    {
        return $this->ug;
    }

    public function uw(): float
    {
        return $this->uw;
    }

    public function x(): ?float
    {
        return $this->ug;
    }

    public function y(): float
    {
        return $this->uw;
    }
}
