<?php

namespace App\Domain\MasqueLointain\Engine;

use App\Domain\MasqueLointain\{MasqueLointain, MasqueLointainCollection};
use App\Domain\MasqueLointain\Enum\Orientation;

/**
 * @see §6.2.2.2 Masques lointains
 */
final class FacteurEnsoleillementCollection
{
    /**
     * @var FacteurEnsoleillement[]
     */
    private array $collection = [];

    private function __construct(private FacteurEnsoleillement $facteur_ensoleillement)
    {
    }

    /**
     * Facteur de réduction de l'ensoleillement dû aux masques lointains
     */
    public function fe2(Orientation|int $orientation): float
    {
        $collection = $this->search_by_orientation($orientation);
        $fe2 = \array_reduce($collection, fn (FacteurEnsoleillement $item, float $min): float => $min = \min($min, $item->fe2()), 1);
        $omb = \min($this->omb($orientation), 0) / 100;

        return \min($fe2, 1 - $omb);
    }

    /**
     * Somme des ombrages due aux masques lointains
     */
    public function omb(Orientation|int $orientation): float
    {
        return \array_reduce(
            $this->search_by_orientation($orientation),
            fn (FacteurEnsoleillement $item, float $omb): float => $omb += $item->omb(), 0
        );
    }

    /**
     * Retourne les facteurs d'ensoleillement des masques lointains correspondant à l'orientation
     * 
     * @return FacteurEnsoleillement[]
     */
    private function search_by_orientation(Orientation|int $orientation): array
    {
        if ($orientation instanceof Orientation) {
            $orientation = $orientation->value;
        }
        return \array_filter(
            $this->collection,
            fn (FacteurEnsoleillement $item) => $item->input()->orientation()->value === $orientation
        );
    }

    /**
     * @return FacteurEnsoleillement[]
     */
    public function to_array(): array
    {
        return $this->collection;
    }

    public function __invoke(MasqueLointainCollection $input): self
    {
        $this->collection = \array_map(
            fn (MasqueLointain $item): FacteurEnsoleillement => ($this->facteur_ensoleillement)($item),
            $input->to_array(),
        );

        return $this;
    }
}
