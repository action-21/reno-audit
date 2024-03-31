<?php

namespace App\Domain\Batiment\Table;

use App\Domain\Common\Enum\Mois;

/**
 * @property $values Nhecl[]
 */
class NheclCollection
{
    public function __construct(public readonly array $values)
    {
    }

    public function get(Mois $mois): ?Nhecl
    {
        return \array_filter($this->values, fn (Nhecl $item): bool => $item->mois == $mois)[0] ?? null;
    }
}
