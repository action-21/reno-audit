<?php

namespace App\Domain\MasqueLointain;

use App\Domain\MasqueLointain\Engine\FacteurEnsoleillementCollection;

final class MasqueLointainEngine
{
    public function __construct(
        private FacteurEnsoleillementCollection $facteur_ensoleillement_collection,
    ) {
    }

    public function facteur_ensoleillement(): FacteurEnsoleillementCollection
    {
       return $this->facteur_ensoleillement_collection;
    }

    public function __invoke(MasqueLointainCollection $input): self
    {
        $this->facteur_ensoleillement_collection = ($this->facteur_ensoleillement_collection)($input);
        return $this;
    }
}
