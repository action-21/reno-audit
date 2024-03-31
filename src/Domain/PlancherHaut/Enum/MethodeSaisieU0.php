<?php

namespace App\Domain\PlancherHaut\Enum;

use App\Domain\Common\Enum\Enum;

enum MethodeSaisieU0: int implements Enum
{
    case INCONNU = 1;
    case VALEUR_FORFAITAIRE = 2;
    case SAISIE_DIRECTE = 3;
    case SAISIE_DIRECTE_AVANT_SURISOLATION_ITE = 4;
    case U_SAISI = 5;

    /** @inheritdoc */
    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::INCONNU => 'Type de paroi inconnu (valeur par défaut)',
            self::VALEUR_FORFAITAIRE => 'Déterminé selon le matériau et épaisseur à partir de la table de valeur forfaitaire',
            self::SAISIE_DIRECTE => 'Saisie direct U0 justifiée à partir des documents justificatifs autorisés',
            self::SAISIE_DIRECTE_AVANT_SURISOLATION_ITE => 'Saisie direct U0 correspondant à la performance de la paroi avec son isolation antérieure ITI (Umur_ITI) lorsqu\'il y a une surisolation ITE réalisée',
            self::U_SAISI => 'u0 non saisi car le U est saisi connu et justifié',
        };
    }
}
