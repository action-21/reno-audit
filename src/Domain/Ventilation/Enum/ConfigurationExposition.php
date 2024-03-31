<?php

namespace App\Domain\Ventilation\Enum;

use App\Domain\Common\Enum\Enum;

enum ConfigurationExposition: int implements Enum
{
    case ID_01 = 1;
    case ID_02 = 2;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Une seule façade exposée',
            self::ID_02 => 'Plusieurs façades exposées',
        };
    }

    /**
     * Coefficient de protection e
     */
    public function coefficient_e(): float
    {
        return match ($this) {
            self::ID_01 => 0.02,
            self::ID_02 => 0.07,
        };
    }

    /**
     * Coefficient de protection f
     */
    public function coefficient_f(): float
    {
        return match ($this) {
            self::ID_01 => 20,
            self::ID_02 => 15,
        };
    }
}
