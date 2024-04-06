<?php

namespace App\Domain\MasqueLointain;

use App\Domain\Enveloppe\EnveloppeEngine;
use App\Domain\MasqueLointain\Engine\FacteurEnsoleillementCollection;

final class MasqueLointainEngine
{
    private EnveloppeEngine $context;

    public function __construct(
        private FacteurEnsoleillementCollection $facteur_ensoleillement_collection,
    ) {
    }

    /**
     * Facteur d'ensoleillement d'une liste de masques lointains
     */
    public function facteur_ensoleillement(): FacteurEnsoleillementCollection
    {
        return $this->facteur_ensoleillement_collection;
    }

    public function input(): MasqueLointainCollection
    {
        return $this->context->input()->masque_lointain_collection();
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
