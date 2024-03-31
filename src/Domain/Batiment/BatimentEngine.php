<?php

namespace App\Domain\Batiment;

use App\Domain\Batiment\Engine\{Deperdition, Situation};
use App\Domain\Common\Store\DataStore;

final class BatimentEngine
{
    use DataStore;

    private Batiment $input;

    public function __construct(
        private Deperdition $deperdition,
        private Situation $situation,
    ) {
    }

    public function deperdition(): Deperdition
    {
        return $this->deperdition;
    }

    public function situation(): Situation
    {
        return $this->situation;
    }

    public function input(): Batiment
    {
        return $this->input;
    }

    public function __invoke(Batiment $input): self
    {
        $this->input = $input;

        $this->deperdition = ($this->deperdition)($input);
        $this->situation = ($this->situation)($input);

        return $this;
    }
}
