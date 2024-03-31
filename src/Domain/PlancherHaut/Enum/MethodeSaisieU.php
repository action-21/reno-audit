<?php

namespace App\Domain\PlancherHaut\Enum;

use App\Domain\Common\Enum\Enum;

enum MethodeSaisieU: int implements Enum
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
    case SAISIE_DIRECTE_DEPUIS_ETUDE = 10;

    /** @inheritdoc */
    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            // type d'isolation = non isolé
            self::ID_01 => 'Non isolé',
            // type d'isolation = inconnu
            self::ID_02 => 'Isolation inconnue (table forfaitaire)',
            // isolation = true + epaisseur_isolation + oritine_donnee = mesure ou observation
            self::ID_03 => 'Epaisseur isolation saisie justifiée par mesure ou observation',
            // isolation = true + epaisseur_isolation + oritine_donnee = document justificatif autorisé
            self::ID_04 => 'Epaisseur isolation saisie justifiée à partir des documents justificatifs autorisés',
            // isolation = true + epaisseur_isolation + lambda_isolation + oritine_donnee = mesure ou observation
            self::ID_05 => 'Resistance isolation saisie justifiée observation de l\'isolant installé et mesure de son épaisseur',
            self::ID_06 => 'Resistance isolation saisie justifiée à partir des documents justificatifs autorisés',
            
            self::ID_07 => 'Année d\'isolation différente de l\'année de construction saisie justifiée (table forfaitaire)',
            // isolé sans période d'isolation
            self::ID_08 => 'Année de construction saisie (table forfaitaire)',
            // u_saisi + origine donnée = document justificatif autorisé
            self::ID_09 => 'Saisie direct U justifiée (à partir des documents justificatifs autorisés)',
            // u_saisi + origine donnée = étude réglementaire
            self::SAISIE_DIRECTE_DEPUIS_ETUDE => 'Saisie direct U depuis RSET/RSEE (étude RT2012/RE2020)',
        };
    }
}
