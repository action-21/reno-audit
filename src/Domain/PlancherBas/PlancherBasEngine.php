<?php

namespace App\Domain\PlancherBas;

use App\Domain\Batiment\BatimentEngine;
use App\Domain\PlancherBas\Engine\DeperditionPlancherBasCollection;

final class PlancherBasEngine
{
    public function __construct(
        private DeperditionPlancherBasCollection $deperdition_plancher_bas_collection,
    ) {
    }

    public function deperdition_plancher_bas(): DeperditionPlancherBasCollection
    {
        return $this->deperdition_plancher_bas_collection;
    }

    public function __invoke(PlancherBasCollection $input, BatimentEngine $context): self
    {
        $this->deperdition_plancher_bas_collection = ($this->deperdition_plancher_bas_collection)($input, $context);

        return $this;
    }
}
