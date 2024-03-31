<?php

namespace App\Domain\Mur;

use App\Domain\Common\Collection\ArrayCollection;

/**
 * @property Mur[] $elements
 */
final class MurCollection extends ArrayCollection
{
    public function find(\Stringable $reference): ?Mur
    {
        return $this->filter(fn (Mur $item): bool => $item->reference() == $reference)->first();
    }

    /**
     * Surfaces déperditives (m²)
     */
    public function surface_deperditive(): float
    {
        return $this->reduce(fn (Mur $item, float $sdep): float => $sdep += $item->surface_pleine(), 0);
    }

    /**
     * @see §18.3
     * 
     * En présence de plusieurs types de parois, le bâtiment sera considéré comme constitué
     * de parois anciennes si la surface de parois anciennes est majoritaire.
     */
    public function paroi_ancienne(): bool
    {
        return $this->filter(fn (Mur $item): bool => $item->caracteristique()->paroi_ancienne)->surface_deperditive() > ($this->surface_deperditive() / 2);
    }
}
