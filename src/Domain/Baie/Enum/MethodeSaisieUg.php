<?php

namespace App\Domain\Baie\Enum;

use App\Domain\Common\Enum\Enum;

enum MethodeSaisieUg: int implements Enum
{
    case ID_01 = 1;
    case ID_02 = 2;
    case ID_03 = 3;

    public function id(): int
    {
        return $this->value;
    }

    public static function createFrom(MethodeSaisieUbaie $enum): self
    {
        return match ($enum) {
            MethodeSaisieUbaie::ID_01 => self::ID_01,
            MethodeSaisieUbaie::ID_02 => self::ID_02,
            MethodeSaisieUbaie::ID_03 => self::ID_02,
            MethodeSaisieUbaie::ID_04 => self::ID_02,
            MethodeSaisieUbaie::ID_05 => self::ID_02,
            MethodeSaisieUbaie::ID_06 => self::ID_02,
            MethodeSaisieUbaie::ID_07 => self::ID_03,
            MethodeSaisieUbaie::ID_08 => self::ID_03,
            MethodeSaisieUbaie::ID_09 => self::ID_03,
            MethodeSaisieUbaie::ID_10 => self::ID_03,
            MethodeSaisieUbaie::ID_11 => self::ID_03,
            MethodeSaisieUbaie::ID_12 => self::ID_03,
            MethodeSaisieUbaie::ID_13 => self::ID_03,
            MethodeSaisieUbaie::ID_14 => self::ID_03,
            MethodeSaisieUbaie::ID_15 => self::ID_01,
        };
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Déterminé selon le type de fermeture à partir de la table de valeur forfaitaire',
            self::ID_02 => 'Saisi directement à partir des documents justificatifs autorisés',
            self::ID_03 => 'Non saisi',
        };
    }
}
