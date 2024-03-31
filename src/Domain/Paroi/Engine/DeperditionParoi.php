<?php

namespace App\Domain\Paroi\Engine;

use App\Domain\Batiment\BatimentEngine;
use App\Domain\Paroi\Paroi;

trait DeperditionParoi
{
    private Paroi $input;
    private BatimentEngine $context;

    /**
     * b,paroi - Coefficient de réduction thermique
     */
    public function b(): float
    {
        if (null === $this->input->local_non_chauffe()) {
            return 1;
        }
        return $this
            ->context
            ->deperdition()
            ->lnc_engine()
            ->reduction_deperdition_collection()
            ->find(lnc: $this->input->local_non_chauffe())
            ?->b() ?? 1;
    }
}
