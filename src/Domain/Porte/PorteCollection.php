<?php

namespace App\Domain\Porte;

use App\Domain\Paroi\OuvertureCollection;

/**
 * @property Porte[] $elements
 */
final class PorteCollection extends OuvertureCollection
{
    /**
     * Retourne la première occurrence de la porte correspondant à la référence en paramètre
     */
    public function find(\Stringable $reference): ?Porte
    {
        return parent::findFirst(fn (Porte $item) => $item->reference() == $reference);
    }

    /**
     * Surfaces déperditives (m²)
     */
    public function surface_deperditive(): float
    {
        return $this->reduce(fn (Porte $item, float $sdep): float => $sdep += $item->surface_deperditive(), 0);
    }
}
