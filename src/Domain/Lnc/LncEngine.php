<?php

namespace App\Domain\Lnc;

use App\Domain\Lnc\Engine\{ReductionDeperditionCollection, SurfaceSudEquivalenteCollection};

final class LncEngine
{
    private Lnc $input;

    public function __construct(
        private ReductionDeperditionCollection $reduction_deperdition_collection,
        private SurfaceSudEquivalenteCollection $surface_sud_equivalente_collection,
    ) {
    }

    public function reduction_deperdition(): ReductionDeperditionCollection
    {
        return $this->reduction_deperdition_collection;
    }

    public function surface_sud_equivalente(): SurfaceSudEquivalenteCollection
    {
        return $this->surface_sud_equivalente_collection;
    }

    public function input(): Lnc
    {
        return $this->input;
    }

    public function __invoke(Lnc $input): self
    {
        $this->input = $input;
        $this->reduction_deperdition_collection = ($this->reduction_deperdition_collection)($input);
        $this->surface_sud_equivalente_collection = ($this->surface_sud_equivalente_collection)($input);

        return $this;
    }
}
