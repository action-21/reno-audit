<?php

namespace App\Domain\Lnc\Table;

use App\Domain\Common\Table\TableValueCollection;
use App\Domain\Paroi\Enum\Orientation;

/**
 * @property CoefficientReductionDeperditionVeranda[] $values
 */
class CoefficientReductionDeperditionVerandaCollection extends TableValueCollection
{
    public function bver(): float
    {
        return 0 < $this->count()
            ? $this->reduce(fn (CoefficientReductionDeperditionVeranda $item, float $bver): float => $bver += $item->bver(), 0) / $this->count()
            : 0;
    }

    /**
     * @param Orientation[] $orientation_collection
     */
    public function search_by_orientation_collectionn(array $orientation_collection): self
    {
        $orientation_collection = \array_map(fn (Orientation $item): int => $item->value, $orientation_collection);
        return $this->filter(fn (CoefficientReductionDeperditionVeranda $item): bool => \count(\array_intersect($orientation_collection, $item->orientations())) > 0);
    }
}
