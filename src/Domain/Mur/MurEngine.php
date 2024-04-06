<?php

namespace App\Domain\Mur;

use App\Domain\Enveloppe\EnveloppeEngine;
use App\Domain\Mur\Engine\DeperditionMurCollection;

final class MurEngine
{
    private EnveloppeEngine $context;

    public function __construct(
        private DeperditionMurCollection $deperdition_mur_collection,
    ) {
    }

    /**
     * Déperditions thermiques d'une liste de murs
     */
    public function deperdition_thermique(): DeperditionMurCollection
    {
        return $this->deperdition_mur_collection;
    }

    public function input(): MurCollection
    {
        return $this->context->input()->mur_collection();
    }

    public function context(): EnveloppeEngine
    {
        return $this->context;
    }

    public function __invoke(EnveloppeEngine $context): self
    {
        $this->context = $context;
        $this->deperdition_mur_collection = ($this->deperdition_mur_collection)($this);
        return $this;
    }
}
