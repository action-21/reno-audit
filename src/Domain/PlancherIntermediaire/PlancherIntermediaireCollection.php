<?php

namespace App\Domain\PlancherIntermediaire;

use App\Domain\Common\Collection\ArrayCollection;
use App\Domain\PlancherIntermediaire\Enum\TypePlancherIntermediaire;

/**
 * Une liste de planchers intermédiaires
 * 
 * @property PlancherIntermediaire[] $elements
 */
final class PlancherIntermediaireCollection extends ArrayCollection
{
    public function find(string $reference): ?PlancherIntermediaire
    {
        return $this->findFirst(fn (PlancherIntermediaire $item) => $item->reference() == $reference);
    }

    /**
     * Surface totale des planchers intermédiaires en m²
     */
    public function surface(): float
    {
        return $this->reduce(fn (PlancherIntermediaire $item, float $surface): float => $surface += $item->surface(), 0);
    }

    /**
     * Filtre par type de plancher intermédiaire
     */
    public function search_by_type(TypePlancherIntermediaire $type_plancher): self
    {
        return $this->filter(fn (PlancherIntermediaire $item) => $item->type_plancher() === $type_plancher);
    }
}
