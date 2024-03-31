<?php

namespace App\Domain\PontThermique;

use App\Domain\PontThermique\Engine\DeperditionPontThermiqueCollection;

final class PontThermiqueEngine
{
    public function __construct(
        private DeperditionPontThermiqueCollection $deperdition_pont_thermique_collection,
    ) {
    }

    public function deperdition_pont_thermique(): DeperditionPontThermiqueCollection
    {
        return $this->deperdition_pont_thermique_collection;
    }

    public function __invoke(PontThermiqueCollection $input): self
    {
        $this->deperdition_pont_thermique_collection = ($this->deperdition_pont_thermique_collection)($input);

        return $this;
    }
}
