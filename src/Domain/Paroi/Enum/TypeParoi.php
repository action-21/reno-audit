<?php

namespace App\Domain\Paroi\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeParoi: int implements Enum
{
    case MUR = 1;
    case PLANCHER_BAS = 2;
    case PLANCHER_HAUT = 3;
    case BAIE = 4;
    case PORTE = 5;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::MUR => 'Mur',
            self::PLANCHER_BAS => 'Plancher bas',
            self::PLANCHER_HAUT => 'Plancher haut',
            self::BAIE => 'Baie',
            self::PORTE => 'Porte',
        };
    }

    public function paroi_opaque(): bool
    {
        return match ($this) {
            self::MUR, self::PLANCHER_BAS, self::PLANCHER_HAUT => true,
            default => false,
        };
    }

    public function ouverture(): bool
    {
        return match ($this) {
            self::BAIE, self::PORTE => true,
            default => false,
        };
    }
}
