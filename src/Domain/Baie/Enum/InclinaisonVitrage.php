<?php

namespace App\Domain\Baie\Enum;

use App\Domain\Common\Enum\Enum;

enum InclinaisonVitrage: int implements Enum
{
    case INFERIEUR_25 = 1;
    case ENTRE_25_ET_75 = 2;
    case SUPERIEUR_75 = 3;
    case HORIZONTAL = 4;

    public function id(): int
    {
        return $this->value;
    }

    public static function create_from_angle(float $angle): self
    {
        return match (true) {
            $angle < 25 => self::INFERIEUR_25,
            $angle >= 25 && $angle <= 75 => self::ENTRE_25_ET_75,
            $angle > 75 && $angle < 180 => self::SUPERIEUR_75,
            $angle >= 180 => self::HORIZONTAL,
        };
    }

    public function lib(): string
    {
        return match ($this) {
            self::INFERIEUR_25 => 'Inférieur à 25°',
            self::ENTRE_25_ET_75 => 'Entre 25° et 75°',
            self::SUPERIEUR_75 => 'Supérieur à 75°',
            self::HORIZONTAL => 'Horizontal'
        };
    }
}
