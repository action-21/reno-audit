<?php

namespace App\Domain\Baie;

use App\Domain\Baie\Engine\{DeperditionBaieCollection, SseBaieCollection};
use App\Domain\Enveloppe\EnveloppeEngine;

final class BaieEngine
{
    private EnveloppeEngine $context;

    public function __construct(
        private DeperditionBaieCollection $deperdition_baie_collection,
        private SseBaieCollection $sse_baie_collection,
    ) {
    }

    /**
     * Déperdition thermique d'une liste de baies
     */
    public function deperdition_thermique(): DeperditionBaieCollection
    {
        return $this->deperdition_baie_collection;
    }

    /**
     * Surface sud équivalente d'une liste de baies
     */
    public function surface_sud_equivalente(): SseBaieCollection
    {
        return $this->sse_baie_collection;
    }

    public function input(): BaieCollection
    {
        return $this->context->input()->baie_collection();
    }

    public function context(): EnveloppeEngine
    {
        return $this->context;
    }

    public function __invoke(EnveloppeEngine $context): self
    {
        $this->context = $context;
        $this->deperdition_baie_collection = ($this->deperdition_baie_collection)($this);
        $this->sse_baie_collection = ($this->sse_baie_collection)($this);
        return $this;
    }
}
