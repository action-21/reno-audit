<?php

namespace App\Domain\PontThermique;

use App\Domain\Enveloppe\EnveloppeEngine;
use App\Domain\PontThermique\Engine\DeperditionPontThermiqueCollection;

final class PontThermiqueEngine
{
    private EnveloppeEngine $context;

    public function __construct(
        private DeperditionPontThermiqueCollection $deperdition_pont_thermique_collection,
    ) {
    }

    /**
     * Déperdition thermique d'une liste de ponts thermiques
     */
    public function deperdition_thermique(): DeperditionPontThermiqueCollection
    {
        return $this->deperdition_pont_thermique_collection;
    }

    public function input(): PontThermiqueCollection
    {
        return $this->context->input()->pont_thermique_collection();
    }

    public function context(): EnveloppeEngine
    {
        return $this->context;
    }

    public function __invoke(EnveloppeEngine $context): self
    {
        $this->context = $context;
        $this->deperdition_pont_thermique_collection = ($this->deperdition_pont_thermique_collection)($this);
        return $this;
    }
}
