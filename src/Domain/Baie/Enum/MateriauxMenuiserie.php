<?php

namespace App\Domain\Baie\Enum;

use App\Domain\Common\Enum\Enum;

enum MateriauxMenuiserie: int implements Enum
{
    case BRIQUE_VERRE = 1;
    case POLYCARBONATE = 2;
    case BOIS = 3;
    case BOIS_METAL = 4;
    case PVC = 5;
    case METAL_AVEC_RUPTEUR_PONT_THERMIQUE = 6;
    case METAL_SANS_RUPTEUR_PONT_THERMIQUE = 7;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::BRIQUE_VERRE => 'Brique de Verre',
            self::POLYCARBONATE => 'Polycarbonate',
            self::BOIS => 'Bois',
            self::BOIS_METAL => 'Bois/métal',
            self::PVC => 'PVC',
            self::METAL_AVEC_RUPTEUR_PONT_THERMIQUE => 'Métal avec rupture de pont thermique',
            self::METAL_SANS_RUPTEUR_PONT_THERMIQUE => 'Métal sans rupture de pont thermique'
        };
    }
}
