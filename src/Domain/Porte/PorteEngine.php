<?php

namespace App\Domain\Porte;

use App\Domain\Batiment\BatimentEngine;
use App\Domain\Porte\Engine\DeperditionPorteCollection;

final class PorteEngine
{
    public function __construct(
        private DeperditionPorteCollection $deperdition_porte,
    ) {
    }

    public function deperdition_porte(): DeperditionPorteCollection
    {
        return $this->deperdition_porte;
    }

    public function __invoke(PorteCollection $input, BatimentEngine $context): self
    {
        $this->deperdition_porte = ($this->deperdition_porte)($input, $context);

        return $this;
    }
}
