<?php

namespace App\Domain\Chauffage\Enum;

enum TypeInstallation: int
{

    case ID_01 = 1;
    case ID_02 = 2;
    case ID_03 = 3;
    case ID_04 = 4;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Installation individuelle',
            self::ID_02 => 'Installation collective',
            self::ID_03 => 'Installation collective multi-bâtiment : modélisée comme un réseau de chaleur',
            self::ID_04 => 'Installation hybride collective-individuelle (chauffage base + appoint individuel ou convecteur bi-jonction)'
        };
    }

    /**
     * Récupération des pertes de stockage
     */
    public function recuperation_pertes_stockage(): bool
    {
        return $this === self::ID_01;
    }

    /**
     * Installation individuelle pour le calcul des pertes de distribution
     */
    public function installation_individuelle(): bool
    {
        return $this === self::ID_01;
    }

    /**
     * Installation collective pour le calcul des pertes de distribution
     */
    public function installation_collective(): bool
    {
        return match ($this) {
            self::ID_01 => false,
            self::ID_02 => true,
            self::ID_03 => true,
            self::ID_04 => true
        };
    }
}
