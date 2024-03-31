<?php

namespace App\Domain\Lnc\Table;

use App\Domain\Common\Table\TableValue;

/**
 * @see §3.1
 */
class Uvue implements TableValue
{
    public function __construct(public readonly int $id, public readonly float $uvue)
    {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function uvue(): float
    {
        return $this->uvue;
    }
}
