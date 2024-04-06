<?php

namespace App\Domain\Audit;

use App\Domain\Batiment\BatimentEngine;

final class AuditEngine
{
    private Audit $input;

    public function __construct(
        private BatimentEngine $batiment_engine,
    ) {
    }

    public function batiment_engine(): BatimentEngine
    {
        return $this->batiment_engine;
    }

    public function input(): Audit
    {
        return $this->input;
    }

    public function __invoke(Audit $input): self
    {
        $this->input = $input;
        $this->batiment_engine = ($this->batiment_engine)($this);
        return $this;
    }
}
