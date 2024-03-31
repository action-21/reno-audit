<?php

namespace App\Domain\Climatisation;

use App\Domain\Climatisation\Enum\TypeGenerateur;
use App\Domain\Common\Collection\ArrayCollection;

/**
 * @property Climatisation[] $elements
 */
final class ClimatisationCollection extends ArrayCollection
{
    public function find(\Stringable $reference): ?Climatisation
    {
        return $this->findFirst(fn (Climatisation $item): bool => $item->reference() == $reference);
    }

    /**
     * Surface climatisée par l'installation (m²)
     */
    public function surface(): float
    {
        return $this->reduce(fn (Climatisation $item, float $surface): float => $surface += $item->surface(), 0);
    }

    /**
     * @return TypeGenerateur[]
     */
    public function uniqueTypes(): array
    {
        $collection = [];
        $exsits = [];

        foreach ($this->elements as $item) {
            if (!\in_array($item->type_generateur()->id(), $exsits)) {
                $collection[] = $item->type_generateur();
                $exsits[] = $item->type_generateur()->id();
            }
        }
        return $collection;
    }
}
