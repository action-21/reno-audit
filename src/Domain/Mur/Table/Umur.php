<?php

namespace App\Domain\Mur\Table;

use App\Domain\Common\Table\TableValue;

class Umur implements TableValue
{
    public function __construct(public readonly int $id, public readonly float $umur)
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function umur(): float
    {
        return $this->umur;
    }
}
