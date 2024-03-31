<?php

namespace App\Domain\Baie\Table;

use App\Domain\Common\Table\TableValue;

class Ujn implements TableValue
{
    public function __construct(
        public readonly int $id,
        public readonly float $uw,
        public readonly float $ujn,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function uw(): float
    {
        return $this->uw;
    }

    public function ujn(): float
    {
        return $this->ujn;
    }

    public function x(): float
    {
        return $this->uw;
    }

    public function y(): float
    {
        return $this->ujn;
    }
}
