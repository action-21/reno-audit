<?php

namespace App\Domain\PlancherHaut;

use App\Domain\Enveloppe\EnveloppeEngine;
use App\Domain\PlancherHaut\Engine\DeperditionPlancherHautCollection;

final class PlancherHautEngine
{
    private EnveloppeEngine $context;

    public function __construct(
        private DeperditionPlancherHautCollection $deperdition_plancher_haut_collection,
    ) {
    }

    /**
     * Déperdition thermique d'une liste de planchers hauts
     */
    public function deperdition_thermique(): DeperditionPlancherHautCollection
    {
        return $this->deperdition_plancher_haut_collection;
    }

    public function input(): PlancherHautCollection
    {
        return $this->context->input()->plancher_haut_collection();
    }

    public function context(): EnveloppeEngine
    {
        return $this->context;
    }

    public function __invoke(EnveloppeEngine $context): self
    {
        $this->context = $context;
        $this->deperdition_plancher_haut_collection = ($this->deperdition_plancher_haut_collection)($this);
        return $this;
    }
}
