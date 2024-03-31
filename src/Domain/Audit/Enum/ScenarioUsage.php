<?php

namespace App\Domain\Audit\Enum;

use App\Domain\Common\Enum\Enum;

enum ScenarioUsage: int implements Enum
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
            self::ID_01 => 'Scénario conventionnel',
            self::ID_02 => 'Scénario dépensier',
        };
    }
}
