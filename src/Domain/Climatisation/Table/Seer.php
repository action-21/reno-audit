<?php

namespace App\Domain\Climatisation\Table;

use App\Domain\Common\Table\TableValue;

class Seer implements TableValue
{
    public function __construct(public readonly int $id, public readonly float $eer,)
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function eer(): float
    {
        return $this->eer;
    }
}
