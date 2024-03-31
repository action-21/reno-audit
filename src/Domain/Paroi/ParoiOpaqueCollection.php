<?php

namespace App\Domain\Paroi;

use Stringable;

/**
 * @property ParoiOpaque[] $elements
 */
class ParoiOpaqueCollection extends ParoiCollection
{
    public function find(Stringable $reference): ?ParoiOpaque
    {
        return parent::find($reference);
    }

    /**
     * Retourne une collection de façade
     */
    public function search_with_facade(): self
    {
        return $this->filter(fn (ParoiOpaque $item): bool => $item->facade());
    }
}
