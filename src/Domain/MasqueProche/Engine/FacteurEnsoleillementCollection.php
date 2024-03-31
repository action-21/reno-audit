<?php

namespace App\Domain\MasqueProche\Engine;

use App\Domain\MasqueProche\{MasqueProche, MasqueProcheCollection};

/**
 * @see §6.2.2.1 Masques proches
 */
final class FacteurEnsoleillementCollection
{
    /**
     * @var FacteurEnsoleillement[]
     */
    private array $collection;

    private function __construct(private FacteurEnsoleillement $facteur_ensoleillement)
    {
    }

    /**
     * Facteur de réduction de l'ensoleillement dû aux masques proches
     * 
     * @param MasqueProcheCollection $masque_proche_collection - Filtre par collection de masques proches
     */
    public function fe1(MasqueProcheCollection $masque_proche_collection): float
    {
        return \min(\array_map(
            fn (FacteurEnsoleillement $item): float => $item->fe1(),
            $this->search_by_masque_proche_collection($masque_proche_collection)
        ));
    }

    /**
     * @return FacteurEnsoleillement[]
     */
    private function search_by_masque_proche_collection(MasqueProcheCollection $masque_proche_collection): array
    {
        return \array_filter(
            $this->collection,
            fn (FacteurEnsoleillement $item) => $masque_proche_collection->find($item->input()->reference()) !== null,
        );
    }

    /**
     * @return FacteurEnsoleillement[]
     */
    public function to_array(): array
    {
        return $this->collection;
    }

    public function __invoke(MasqueProcheCollection $input): self
    {
        $this->collection = \array_map(
            fn (MasqueProche $item): FacteurEnsoleillement => ($this->facteur_ensoleillement)($item),
            $input->to_array(),
        );

        return $this;
    }
}
