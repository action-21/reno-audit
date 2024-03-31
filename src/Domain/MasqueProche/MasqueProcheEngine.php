<?php

namespace App\Domain\MasqueProche;

use App\Domain\MasqueProche\Engine\FacteurEnsoleillementCollection;

final class MasqueProcheEngine
{
    public function __construct(
        private FacteurEnsoleillementCollection $facteur_ensoleillement_collection,
    ) {
    }

    public function facteur_ensoleillement(): FacteurEnsoleillementCollection
    {
       return $this->facteur_ensoleillement_collection;
    }

    public function __invoke(MasqueProcheCollection $input): self
    {
        $this->facteur_ensoleillement_collection = ($this->facteur_ensoleillement_collection)($input);
        return $this;
    }
}
