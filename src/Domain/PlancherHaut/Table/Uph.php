<?php

namespace App\Domain\PlancherHaut\Table;

use App\Domain\Common\Table\TableValue;

/**
 * Valeur forfaitaire du coefficient de transmission thermique d'un plancher haut
 */
class Uph implements TableValue
{
    public function __construct(public readonly int $id, public readonly float $uph)
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function uph(): float
    {
        return $this->uph;
    }
}
