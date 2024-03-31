<?php

namespace App\Domain\Ecs\Enum;

enum ConfigurationInstallation: int
{
    case ID_01 = 1;
    case ID_02 = 2;
    case ID_03 = 3;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Un seul système d\'ECS sans solaire',
            self::ID_02 => 'Un seul système d\'ECS avec solaire',
            self::ID_03 => 'Deux systèmes d\'ECS dans une maison ou un appartement'
        };
    }

    /**
     * Ratio de l'installation en fonction de la configuration pris pour application de la section 11.4 de la méthode 3CL-DPE
     */
    public function ratio(): float
    {
        return match ($this) {
            self::ID_01 => 1,
            self::ID_02 => 1,
            self::ID_03 => 0.5
        };
    }
}
