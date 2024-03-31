<?php

namespace App\Domain\Refend;

use App\Domain\Common\Collection\ArrayCollection;

/**
 * @property Refend[] $elements
 */
final class RefendCollection extends ArrayCollection
{
    /**
     * Retourne la première occurence d'un refend par sa référence
     */
    public function find(\Stringable $reference): ?Refend
    {
        return $this->filter(fn (Refend $item): bool => $item->reference() == $reference)->first();
    }
}
