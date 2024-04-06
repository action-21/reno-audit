<?php

namespace App\Domain\MasqueProche;

use App\Domain\Enveloppe\EnveloppeEngine;
use App\Domain\MasqueProche\Engine\FacteurEnsoleillementCollection;

final class MasqueProcheEngine
{
    private EnveloppeEngine $context;

    public function __construct(
        private FacteurEnsoleillementCollection $facteur_ensoleillement_collection,
    ) {
    }

    /**
     * Facteur d'ensoleillement d'une liste de masques proches
     */
    public function facteur_ensoleillement(): FacteurEnsoleillementCollection
    {
        return $this->facteur_ensoleillement_collection;
    }

    public function input(): MasqueProcheCollection
    {
        return $this->context->input()->masque_proche_collection();
    }

    public function context(): EnveloppeEngine
    {
        return $this->context;
    }

    public function __invoke(EnveloppeEngine $context): self
    {
        $this->context = $context;
        $this->facteur_ensoleillement_collection = ($this->facteur_ensoleillement_collection)($this);
        return $this;
    }
}
