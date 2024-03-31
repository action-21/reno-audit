<?php

namespace App\Domain\PlancherBas;

use App\Domain\Paroi\ParoiOpaqueCollection;

/**
 * @property PlancherBas[] $elements
 */
final class PlancherBasCollection extends ParoiOpaqueCollection
{
    /**
     * Surfaces déperditives (m²)
     */
    public function surface_deperditive(): float
    {
        return $this->reduce(fn (PlancherBas $item, float $sdep): float => $sdep += $item->surface_pleine(), 0);
    }
}
