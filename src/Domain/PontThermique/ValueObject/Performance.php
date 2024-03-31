<?php

namespace App\Domain\PontThermique\ValueObject;

use App\Domain\PontThermique\Enum\MethodeSaisiePontThermique;

final class Performance
{
    public function __construct(
        public readonly ?float $k_saisi,
        public readonly MethodeSaisiePontThermique $methode_saisie,
    ) {
    }
}
