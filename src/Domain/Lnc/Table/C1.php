<?php

namespace App\Domain\Lnc\Table;

use App\Domain\Common\Enum\Mois;
use App\Domain\Common\Table\TableValue;

class C1 implements TableValue
{
    public function __construct(
        public readonly int $id,
        public readonly Mois $mois,
        public readonly float $c1,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function mois(): Mois
    {
        return $this->mois;
    }

    public function c1(): float
    {
        return $this->c1;
    }
}
