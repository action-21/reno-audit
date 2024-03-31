<?php

namespace App\Domain\Mur\Enum;

use App\Domain\Common\Enum\Enum;

enum MethodeSaisieU0: int implements Enum
{
    case ID_01 = 1;
    case ID_02 = 2;
    case ID_03 = 3;
    case ID_04 = 4;
    case ID_05 = 5;

    /** @inheritdoc */
    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Type de paroi inconnu (valeur par défaut)',
            self::ID_02 => 'Déterminé selon le matériau et épaisseur à partir de la table de valeur forfaitaire',
            self::ID_03 => 'Saisie direct U0 justifiée à partir des documents justificatifs autorisés',
            self::ID_04 => 'Saisie direct U0 correspondant à la performance de la paroi avec son isolation antérieure ITI (Umur_ITI) lorsqu\'il y a une surisolation ITE réalisée',
            self::ID_05 => 'u0 non saisi car le U est saisi connu et justifié',
        };
    }
}
