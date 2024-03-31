<?php

namespace App\Domain\Lnc\Entity;

use App\Domain\Common\Collection\ArrayCollection;
use App\Domain\Paroi\Enum\Orientation;

/**
 * @property Baie[] $elements
 */
final class BaieCollection extends ArrayCollection
{
    public function find(\Stringable $reference): ?Baie
    {
        return $this->filter(fn (Baie $item): bool => $item->reference() === $reference)->first();
    }

    /**
     * Recherche les baies prinipales de l'espace tampon solarisé
     */
    public function search_by_orientation(): self
    {
        /** @var Orientation[] */
        $orientations = [];
        $max = 0;

        foreach (Orientation::cases() as $orientation) {
            $surface = $this
                ->filter(fn (Baie $item): bool => $item->orientation()->vertical() && $item->orientation() === $orientation)
                ->reduce(fn (Baie $item, float $surface): float => $surface += $item->surface(), 0);

            if ($surface >= $max) {
                $max = $surface;
                $orientations[] = $orientation;
            }
        }

        return $this->filter(fn (Baie $item): bool => \in_array($item->orientation(), $orientations));
    }

    /**
     * Retourne les orientations majoritaires d'une collection de baies
     * 
     * @return Orientation[]
     */
    public function orientations(): array
    {
        return \array_unique(\array_map(
            fn (Baie $item): Orientation => $item->orientation(),
            $this->search_by_orientation()->values()
        ));
    }
}
