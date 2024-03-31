<?php

namespace App\Domain\PlancherIntermediaire\Enum;

use App\Domain\Common\Enum\Enum;

enum TypePlancherIntermediaire: int implements Enum
{
    case PLANCHER_INFERIEUR_LOURD = 1;
    case PLANCHER_SUPERIEUR_LOURD = 2;

    /** @inheritdoc */
    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this->value) {
            self::PLANCHER_INFERIEUR_LOURD => 'Sous-face de plancher intermédiaire sans isolant et sans faux plafond',
            self::PLANCHER_SUPERIEUR_LOURD => 'Face supérieure de plancher intermédiaire avec un revêtement non isolant',
        };
    }
}
