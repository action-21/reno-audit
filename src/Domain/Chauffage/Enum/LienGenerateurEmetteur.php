<?php

namespace App\Domain\Chauffage\Enum;

enum LienGenerateurEmetteur: int
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
            self::ID_01 => 'Génération principale - emetteur lié à la génération principale',
            self::ID_02 => 'Génération appoint - emetteur lié à la génération d\'appoint',
            self::ID_03 => 'Génération appoint electrique salle de bain - emetteur lié à la génération appoint electrique salle de bain'
        };
    }
}
