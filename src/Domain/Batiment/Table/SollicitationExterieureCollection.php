<?php

namespace App\Domain\Batiment\Table;

use App\Domain\Common\Enum\Mois;

/**
 * @property SollicitationExterieure[] $values
 */
class SollicitationExterieureCollection
{
    public function __construct(public readonly array $values)
    {
    }

    public function get(Mois $mois): ?SollicitationExterieure
    {
        return \array_filter($this->values, fn (SollicitationExterieure $item): bool => $item->mois == $mois)[0] ?? null;
    }
}
