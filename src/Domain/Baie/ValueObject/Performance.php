<?php

namespace App\Domain\Baie\ValueObject;

use App\Domain\Baie\Enum\MethodeSaisieSw;

final class Performance
{
    public function __construct(
        public readonly ?float $sw_saisi,
        public readonly MethodeSaisieSw $methode_saisie_sw,
    ) {
    }
}
