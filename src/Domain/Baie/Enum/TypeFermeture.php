<?php

namespace App\Domain\Baie\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeFermeture: int implements Enum
{
    case JALOUSIE_ACCORDEON = 1;
    case FERMETURE_LAMES_ORIENTABLES = 2;
    case VENITIENS_EXTERIEURS_METAL = 3;
    case VOLET_BATTANT_AVEC_AJOURS_FIXES = 4;
    case PERSIENNES_AVEC_AJOURS_FIXES = 5;
    case FERMETURE_SANS_AJOURS = 6;
    case VOLETS_ROULANTS_ALUMINIUM = 7;
    case VOLETS_ROULANTS_PVC_BOIS_EPAISSEUR_LTE_12MM = 8;
    case VOLETS_ROULANTS_PVC_BOIS_EPAISSEUR_GT_12MM = 9;
    case PERSIENNE_COULISSANTE_EPAISSEUR_LTE_22MM = 10;
    case PERSIENNE_COULISSANTE_EPAISSEUR_GT_22MM = 11;
    case VOLET_BATTANT_PVC_BOIS_EPAISSEUR_LTE_22MM = 12;
    case VOLET_BATTANT_PVC_BOIS_EPAISSEUR_GT_22MM = 13;
    case FERMETURE_ISOLEE_SANS_AJOURS = 14;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::JALOUSIE_ACCORDEON => 'Jalousie accordéon',
            self::FERMETURE_LAMES_ORIENTABLES => 'Fermeture à lames orientables',
            self::VENITIENS_EXTERIEURS_METAL => 'Vénitiens extérieurs tout métal',
            self::VOLET_BATTANT_AVEC_AJOURS_FIXES => 'Volet battant avec ajours fixes',
            self::PERSIENNES_AVEC_AJOURS_FIXES => 'Persiennes avec ajours fixes',
            self::FERMETURE_SANS_AJOURS => 'Fermeture sans ajours en position déployée',
            self::VOLETS_ROULANTS_ALUMINIUM => 'Volet roulant aluminium',
            self::VOLETS_ROULANTS_PVC_BOIS_EPAISSEUR_LTE_12MM => 'Volet roulant PVC ou bois d\'épaisseur inférieure ou égale à 12mm',
            self::VOLETS_ROULANTS_PVC_BOIS_EPAISSEUR_GT_12MM => 'Volet roulant PVC ou bois d\'épaisseur supérieure à 12mm',
            self::PERSIENNE_COULISSANTE_EPAISSEUR_LTE_22MM => 'Persienne coulissante d\'épaisseur inférieure ou égale à 22mm',
            self::PERSIENNE_COULISSANTE_EPAISSEUR_GT_22MM => 'Persienne coulissante d\'épaisseur supérieure à 22mm',
            self::VOLET_BATTANT_PVC_BOIS_EPAISSEUR_LTE_22MM => 'Volet battant PVC ou bois d\'épaisseur inférieure ou égale à 22mm',
            self::VOLET_BATTANT_PVC_BOIS_EPAISSEUR_GT_22MM => 'Volet battant PVC ou bois d\'épaisseur supérieure à 22mm',
            self::FERMETURE_ISOLEE_SANS_AJOURS => 'Fermeture isolée sans ajours en position déployée',
        };
    }
}
