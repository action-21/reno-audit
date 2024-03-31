<?php

namespace App\Domain\Audit\ValueObject;

final class Proprietaire
{
    public function __construct(
        public readonly string $nom,
        public readonly ?string $siren,
    ) {
    }
}
