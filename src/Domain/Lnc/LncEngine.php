<?php

namespace App\Domain\Lnc;

use App\Domain\Enveloppe\EnveloppeEngine;
use App\Domain\Lnc\Engine\{ReductionDeperditionCollection, SurfaceSudEquivalenteCollection};

final class LncEngine
{
    private EnveloppeEngine $context;

    public function __construct(
        private ReductionDeperditionCollection $reduction_deperdition_collection,
        private SurfaceSudEquivalenteCollection $surface_sud_equivalente_collection,
    ) {
    }

    /**
     * Réduction des déperditions thermiques d'une liste de locaux non chauffés
     */
    public function reduction_deperdition(): ReductionDeperditionCollection
    {
        return $this->reduction_deperdition_collection;
    }

    /**
     * Surface sud équivalente d'une liste de locaux non chauffés
     */
    public function surface_sud_equivalente(): SurfaceSudEquivalenteCollection
    {
        return $this->surface_sud_equivalente_collection;
    }

    public function input(): LncCollection
    {
        return $this->context->input()->lnc_collection();
    }

    public function context(): EnveloppeEngine
    {
        return $this->context;
    }

    public function __invoke(EnveloppeEngine $context): self
    {
        $this->context = $context;
        $this->reduction_deperdition_collection = ($this->reduction_deperdition_collection)($this);
        $this->surface_sud_equivalente_collection = ($this->surface_sud_equivalente_collection)($this);
        return $this;
    }
}
