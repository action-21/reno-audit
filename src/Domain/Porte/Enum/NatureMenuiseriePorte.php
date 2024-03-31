<?php

namespace App\Domain\Porte\Enum;

use App\Domain\Common\Enum\Enum;

enum NatureMenuiseriePorte: int implements Enum
{
    case PORTE_SIMPLE_BOIS = 1;
    case PORTE_SIMPLE_PVC = 2;
    case PORTE_SIMPLE_METAL = 3;
    case AUTRES = 4;

    public static function from_type_porte(TypePorte $typePorte): self
    {
        return match ($typePorte) {
            TypePorte::ID_01, TypePorte::ID_02, TypePorte::ID_03, TypePorte::ID_04 => self::PORTE_SIMPLE_BOIS,
            TypePorte::ID_05, TypePorte::ID_06, TypePorte::ID_07, TypePorte::ID_08 => self::PORTE_SIMPLE_PVC,
            TypePorte::ID_09, TypePorte::ID_10, TypePorte::ID_11, TypePorte::ID_12 => self::PORTE_SIMPLE_METAL,
            TypePorte::ID_13, TypePorte::ID_14, TypePorte::ID_15 => self::AUTRES,
        };
    }

    /** @inheritdoc */
    public function id(): int
    {
        return $this->value;
    }

    /** @inheritdoc */
    public function lib(): string
    {
        return match ($this) {
            self::PORTE_SIMPLE_BOIS => 'Porte simple en bois',
            self::PORTE_SIMPLE_PVC => 'Porte simple en PVC',
            self::PORTE_SIMPLE_METAL => 'Porte simple en métal',
            self::AUTRES => 'Toute menuiserie',
        };
    }
}
