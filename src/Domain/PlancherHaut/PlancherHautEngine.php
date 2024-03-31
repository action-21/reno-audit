<?php

namespace App\Domain\PlancherHaut;

use App\Domain\Batiment\BatimentEngine;
use App\Domain\PlancherHaut\Engine\DeperditionPlancherHautCollection;

final class PlancherHautEngine
{
    public function __construct(
        private DeperditionPlancherHautCollection $deperdition_plancher_haut_collection,
    ) {
    }

    public function deperdition_plancher_haut(): DeperditionPlancherHautCollection
    {
        return $this->deperdition_plancher_haut_collection;
    }

    public function __invoke(PlancherHautCollection $input, BatimentEngine $context): self
    {
        $this->deperdition_plancher_haut_collection = ($this->deperdition_plancher_haut_collection)($input, $context);

        return $this;
    }
}
