<?php

namespace App\Domain\Audit\Engine;

use App\Domain\Audit\Audit;
use App\Domain\Common\Store\DataStore;

final class Performance
{
    use DataStore;

    private Audit $input;

    public function input(): Audit
    {
        return $this->input;
    }

    public function __invoke(Audit $input): self
    {
        $this->input = $input;
        return $this;
    }
}
