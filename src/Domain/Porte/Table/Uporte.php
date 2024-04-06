<?php

namespace App\Domain\Porte\Table;

use App\Domain\Common\Table\TableValue;

/**
 * Valeur forfaitaire Uporte
 */
class Uporte implements TableValue
{
    public function __construct(public readonly int $id, public readonly float $uporte)
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function uporte(): float
    {
        return $this->uporte;
    }
}
