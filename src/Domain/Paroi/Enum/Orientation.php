<?php

namespace App\Domain\Paroi\Enum;

use App\Domain\Common\Enum\Enum;

enum Orientation: int implements Enum
{
    case SUD = 1;
    case NORD = 2;
    case EST = 3;
    case OUEST = 4;
    case HORIZONTAL = 5;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::SUD => 'Sud',
            self::NORD => 'Nord',
            self::EST => 'Est',
            self::OUEST => 'Ouest',
            self::HORIZONTAL => 'Horizontal',
        };
    }

    public function applicable(TypeParoi $type_paroi): bool
    {
        return match ($type_paroi) {
            TypeParoi::MUR => $this->vertical(),
            TypeParoi::PLANCHER_BAS => $this->horizontal(),
            default => true,
        };
    }

    public function horizontal(): bool
    {
        return $this === self::HORIZONTAL;
    }

    public function vertical(): bool
    {
        return $this !== self::HORIZONTAL;
    }
}
