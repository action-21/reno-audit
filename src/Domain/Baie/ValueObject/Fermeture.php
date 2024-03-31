<?php

namespace App\Domain\Baie\ValueObject;

use App\Domain\Baie\Enum\{MethodeSaisieUjn, TypeFermeture};

final class Fermeture
{
    public function __construct(
        public readonly ?float $ujn_saisi,
        public readonly TypeFermeture $type_fermeture,
        public readonly MethodeSaisieUjn $methode_saisie_ujn,
    ) {
    }
}
