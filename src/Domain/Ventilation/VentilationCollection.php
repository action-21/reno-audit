<?php

namespace App\Domain\Ventilation;

use App\Domain\Common\Collection\ArrayCollection;
use App\Domain\Ventilation\Enum\TypeVentilation;

/**
 * @property Ventilation[] $elements
 */
final class VentilationCollection extends ArrayCollection
{
    public function filterByType(TypeVentilation $type_ventilation): self
    {
        return $this->filter(fn (Ventilation $item): bool => $item->type_ventilation() == $type_ventilation);
    }

    /**
     * Surface ventilée par l'installation (m²)
     */
    public function surface_ventile(): float
    {
        return $this->reduce(fn (Ventilation $item, float $surface): float => $surface += $item->logement()->surface_habitable(), 0);
    }

    /**
     * @return TypeVentilation[]
     */
    public function uniqueTypes(): array
    {
        $collection = [];
        $exsits = [];

        foreach ($this->elements as $item) {
            if (!\in_array($item->type_ventilation()->id(), $exsits)) {
                $collection[] = $item->type_ventilation();
                $exsits[] = $item->type_ventilation()->id();
            }
        }
        return $collection;
    }
}
