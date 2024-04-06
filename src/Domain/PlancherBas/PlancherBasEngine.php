<?php

namespace App\Domain\PlancherBas;

use App\Domain\Enveloppe\EnveloppeEngine;
use App\Domain\PlancherBas\Engine\DeperditionPlancherBasCollection;

final class PlancherBasEngine
{
    private EnveloppeEngine $context;

    public function __construct(
        private DeperditionPlancherBasCollection $deperdition_plancher_bas_collection,
    ) {
    }

    /**
     * Déperdition thermique d'une liste de planchers bas
     */
    public function deperdition_thermique(): DeperditionPlancherBasCollection
    {
        return $this->deperdition_plancher_bas_collection;
    }

    public function input(): PlancherBasCollection
    {
        return $this->context->input()->plancher_bas_collection();
    }

    public function context(): EnveloppeEngine
    {
        return $this->context;
    }

    public function __invoke(EnveloppeEngine $context): self
    {
        $this->context = $context;
        $this->deperdition_plancher_bas_collection = ($this->deperdition_plancher_bas_collection)($this);
        return $this;
    }
}
