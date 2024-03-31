<?php

namespace App\Domain\MasqueLointain;

use App\Domain\Common\Collection\ArrayCollection;
use App\Domain\MasqueLointain\Enum\Orientation;

/**
 * @property MasqueLointain[] $elements
 */
final class MasqueLointainCollection extends ArrayCollection
{
    /**
     * Retourne la première occurence correspondant à la référence
     */
    public function find(\Stringable $reference): ?MasqueLointain
    {
        return $this->findFirst(fn (MasqueLointain $element) => $element->reference() == $reference);
    }

    /**
     * Retourne une collection filtrée par orientation
     */
    public function searchByOrientation(Orientation|int $orientation): self
    {
        $orientation = \is_int($orientation) ? Orientation::tryFrom($orientation) : $orientation;

        return $this->filter(fn (MasqueLointain $item): bool => $item->orientation() == $orientation);
    }
}
