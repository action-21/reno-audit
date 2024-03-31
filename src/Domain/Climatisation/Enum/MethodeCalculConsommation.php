<?php

namespace App\Domain\Climatisation\Enum;

use App\Domain\Common\Enum\Enum;

enum MethodeCalculConsommation: int implements Enum
{
    case ID_01 = 1;
    case ID_02 = 2;
    case ID_03 = 3;
    case ID_04 = 4;
    case ID_05 = 5;
    case ID_06 = 6;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Calcul simple',
            self::ID_02 => 'Installation collective rapportée à un logement : cas générateur à combustion virtuel ou ECS collective virtuelle',
            self::ID_03 => 'Installation collective rapportée à un logement : cas générateurs simples (réseau de chaleur, effet joule, PAC, CET)',
            self::ID_04 => 'Échantillonage des installations individuelles pour le calcul DPE immeuble (calcul effectué sur un logement représentatif d\'un ensemble de logements puis extrapolation sur l\'ensemble de logements du groupe)',
            self::ID_05 => 'Installation collective immeuble mixte rapporté à la partie logement : cas générateur à combustion virtuel ou ECS collective virtuelle',
            self::ID_06 => 'Installation collective immeuble mixte rapporté à la partie logement : cas générateurs simples (réseau de chaleur, effet joule, PAC, CET)',
        };
    }
}