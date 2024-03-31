<?php

namespace App\Domain\Audit\Travaux;

final class Travaux
{
    public function __construct(
        private readonly \Stringable $reference
    ) {
    }

    public function reference(): \Stringable
    {
        return $this->reference;
    }
}
