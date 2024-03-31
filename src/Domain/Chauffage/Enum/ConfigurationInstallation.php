<?php

namespace App\Domain\Chauffage\Enum;

enum ConfigurationInstallation: int
{
    case ID_01 = 1;
    case ID_02 = 2;
    case ID_03 = 3;
    case ID_04 = 4;
    case ID_05 = 5;
    case ID_06 = 6;
    case ID_07 = 7;
    case ID_08 = 8;
    case ID_09 = 9;
    case ID_10 = 10;
    case ID_11 = 11;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Installation de chauffage simple',
            self::ID_02 => 'Installation de chauffage avec chauffage solaire',
            self::ID_03 => 'Installation de chauffage avec insert ou poêle bois en appoint',
            self::ID_04 => 'Installation de chauffage par insert, poêle bois (ou biomasse) avec un chauffage électrique dans la salle de bain',
            self::ID_05 => 'Installation de chauffage avec en appoint un insert ou poêle bois et un chauffage électrique dans la salle de bain (différent du chauffage principal)',
            self::ID_06 => 'Installation de chauffage avec une chaudière ou une PAC en relève d’une chaudière bois',
            self::ID_07 => 'Installation de chauffage avec chauffage solaire et insert ou poêle bois en appoint',
            self::ID_08 => 'Installation de chauffage avec chaudière en relève de PAC',
            self::ID_09 => 'Installation de chauffage avec chaudière en relève de PAC avec insert ou poêle bois en appoint',
            self::ID_10 => 'Installation de chauffage collectif avec Base + appoint',
            self::ID_11 => 'Convecteurs bi-jonction'
        };
    }

    public function chauffage_solaire(): bool
    {
        return match ($this) {
            self::ID_02 => true,
            self::ID_07 => true,
            default => false
        };
    }
}
