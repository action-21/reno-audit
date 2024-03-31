<?php

namespace App\Domain\Lnc\Entity;

use App\Domain\Common\Collection\ArrayCollection;

/**
 * @property Paroi[] $elements
 */
final class ParoiCollection extends ArrayCollection
{
    public function find(\Stringable $reference): ?Paroi
    {
        return $this->findFirst(fn (Paroi $item): bool => $item->reference() === $reference);
    }

    /**
     * Retourne la somme des surfaces des parois du LNC
     */
    public function surface(): float
    {
        return $this->reduce(fn (Paroi $item, float $surface): float => $surface += $item->surface(), 0);
    }

    /**
     * Retourne l'état d'isolation majoritaire des parois du LNC - Faux par défaut
     */
    public function isolation(): bool
    {
        return $this->filter(fn (Paroi $item): bool => $item->isolation())->surface() > ($this->surface() / 2);
    }
}
