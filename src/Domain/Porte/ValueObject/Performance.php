<?php

namespace App\Domain\Porte\ValueObject;

use App\Domain\Porte\Enum\MethodeSaisieUporte;

final class Performance
{
    public function __construct(
        public readonly ?float $uporte_saisi,
        public readonly MethodeSaisieUporte $methode_saisie_uporte,
    ) {
    }

    public static function create_from_valeur_forfaitaire(): self
    {
        return new self(
            uporte_saisi: null,
            methode_saisie_uporte: MethodeSaisieUporte::VALEUR_FORFAITAIRE,
        );
    }

    public static function create_from_valeur_justifiee(float $uporte_saisi): self
    {
        return new self(
            uporte_saisi: $uporte_saisi,
            methode_saisie_uporte: MethodeSaisieUporte::VALEUR_JUSTIFIEE,
        );
    }

    public static function create_from_etude_reglementaire(float $uporte_saisi): self
    {
        return new self(
            uporte_saisi: $uporte_saisi,
            methode_saisie_uporte: MethodeSaisieUporte::VALEUR_ETUDE_REGLEMENTAIRE,
        );
    }
}
