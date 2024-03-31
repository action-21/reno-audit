<?php

namespace App\Domain\Batiment\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeBatiment: int implements Enum
{
    case MAISON = 1;
    case APPARTEMENT = 2;
    case IMMEUBLE = 3;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::MAISON => 'Maison',
            self::APPARTEMENT => 'Appartement',
            self::IMMEUBLE => 'Immeuble'
        };
    }

    /**
     * Ratio du temps d'utilisation pour les ventilations hybrides (1 par défaut)
     */
    public function ratio_temps_utilisation_ventilation(): ?float
    {
        return match ($this) {
            self::MAISON => 0.083,
            self::APPARTEMENT => 0.167,
            self::IMMEUBLE => 0.167,
            default => 1
        };
    }

    public function maison(): bool
    {
        return $this === self::MAISON;
    }

    public function appartement(): bool
    {
        return $this === self::APPARTEMENT;
    }

    public function immeuble(): bool
    {
        return $this === self::IMMEUBLE;
    }
}
