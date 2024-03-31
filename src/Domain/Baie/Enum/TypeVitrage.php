<?php

namespace App\Domain\Baie\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeVitrage: int implements Enum
{
    case SIMPLE_VITRAGE = 1;
    case DOUBLE_VITRAGE = 2;
    case TRIPLE_VITRAGE = 3;
    case SURVITRAGE = 4;
    case BRIQUE_VERRE = 5;
    case POLYCARBONATE = 6;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::SIMPLE_VITRAGE => 'Simple vitrage',
            self::DOUBLE_VITRAGE => 'Double vitrage',
            self::TRIPLE_VITRAGE => 'Triple vitrage',
            self::SURVITRAGE => 'Survitrage',
            self::BRIQUE_VERRE => 'Brique de Verre',
            self::POLYCARBONATE => 'Polycarbonate'
        };
    }

    public function isolation(): bool
    {
        return match ($this) {
            self::TRIPLE_VITRAGE => true,
            default => false,
        };
    }
}
