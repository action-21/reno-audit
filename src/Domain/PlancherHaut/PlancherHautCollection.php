<?php

namespace App\Domain\PlancherHaut;

use App\Domain\Paroi\ParoiOpaqueCollection;

/**
 * @property PlancherHaut[] $elements
 */
final class PlancherHautCollection extends ParoiOpaqueCollection
{
    /**
     * Surfaces déperditives (m²)
     */
    public function surface_deperditive(): float
    {
        return $this->reduce(fn (PlancherHaut $item, float $sdep): float => $sdep += $item->surface_pleine(), 0);
    }
}
