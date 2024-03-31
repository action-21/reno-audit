<?php

namespace App\Domain\Mur;

use App\Domain\Batiment\BatimentEngine;
use App\Domain\Mur\Engine\DeperditionMurCollection;

final class MurEngine
{
    public function __construct(
        private DeperditionMurCollection $deperdition_mur_collection,
    ) {
    }

    public function deperdition_mur(): DeperditionMurCollection
    {
        return $this->deperdition_mur_collection;
    }

    public function __invoke(MurCollection $input, BatimentEngine $context): self
    {
        $this->deperdition_mur_collection = ($this->deperdition_mur_collection)($input, $context);

        return $this;
    }
}
