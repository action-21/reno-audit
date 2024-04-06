<?php

namespace App\Domain\Porte;

use App\Domain\Enveloppe\EnveloppeEngine;
use App\Domain\Porte\Engine\DeperditionPorteCollection;

final class PorteEngine
{
    private EnveloppeEngine $context;

    public function __construct(
        private DeperditionPorteCollection $deperdition_porte,
    ) {
    }

    /**
     * Déperdition thermique d'une liste de portes
     */
    public function deperdition_thermique(): DeperditionPorteCollection
    {
        return $this->deperdition_porte;
    }

    public function input(): PorteCollection
    {
        return $this->context->input()->porte_collection();
    }

    public function context(): EnveloppeEngine
    {
        return $this->context;
    }

    public function __invoke(EnveloppeEngine $context): self
    {
        $this->context = $context;
        $this->deperdition_porte = ($this->deperdition_porte)($this);
        return $this;
    }
}
