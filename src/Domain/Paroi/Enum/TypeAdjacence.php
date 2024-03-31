<?php

namespace App\Domain\Paroi\Enum;

use App\Domain\Common\Enum\Enum;
use App\Domain\Lnc\Enum\TypeLnc;

enum TypeAdjacence: int implements Enum
{
    case EXTERIEUR = 1;
    case PAROI_ENTERREE = 2;
    case VIDE_SANITAIRE = 3;
    case BATIMENT_OU_LOCAL_HORS_HABITATION = 4;
    case TERRE_PLEIN = 5;
    case SOUS_SOL_NON_CHAUFFEE = 6;
    case LOCAL_NON_CHAUFFE_NON_ACCESSIBLE = 7;
    case GARAGE = 8;
    case CELLIER = 9;
    case ESPACE_TAMPON_SOLARISE = 10;
    case COMBLE_FORTEMENT_VENTILE = 11;
    case COMBLE_FAIBLEMENT_VENTILE = 12;
    case COMBLE_TRES_FAIBLEMENT_VENTILE = 13;
    case CIRCULATION_SANS_OUVERTURE_EXTERIEUR = 14;
    case CIRCULATION_AVEC_OUVERTURE_EXTERIEUR = 15;
    case CIRCULATION_AVEC_BOUCHE_OU_GAINE_DESENFUMAGE_OUVERTE = 16;
    case HALL_AVEC_FERMETURE_AUTOMATIQUE = 17;
    case HALL_SANS_FERMETURE_AUTOMATIQUE = 18;
    case GARAGE_PRIVE_COLLECTIF = 19;
    case LOCAL_TERTIAIRE_DANS_IMMEUBLE = 20;
    case AUTRES_DEPENDANCES = 21;
    case LOCAL_NON_DEPERDITIF = 22;

    public static function create_from_opendata(int $type_adjacence_id): self
    {
        return self::from($type_adjacence_id);
    }

    public static function create_from(Mitoyennete $mitoyennete, ?TypeLnc $type_lnc): self
    {
        if ($type_lnc) {
            return match ($type_lnc) {
                TypeLnc::GARAGE => self::GARAGE,
                TypeLnc::CELLIER => self::CELLIER,
                TypeLnc::ESPACE_TAMPON_SOLARISE => self::ESPACE_TAMPON_SOLARISE,
                TypeLnc::COMBLE_FORTEMENT_VENTILE => self::COMBLE_FORTEMENT_VENTILE,
                TypeLnc::COMBLE_FAIBLEMENT_VENTILE => self::COMBLE_FAIBLEMENT_VENTILE,
                TypeLnc::COMBLE_TRES_FAIBLEMENT_VENTILE => self::COMBLE_TRES_FAIBLEMENT_VENTILE,
                TypeLnc::CIRCULATION_SANS_OUVERTURE_EXTERIEUR => self::CIRCULATION_SANS_OUVERTURE_EXTERIEUR,
                TypeLnc::CIRCULATION_AVEC_OUVERTURE_EXTERIEUR => self::CIRCULATION_AVEC_OUVERTURE_EXTERIEUR,
                TypeLnc::CIRCULATION_AVEC_BOUCHE_OU_GAINE_DESENFUMAGE_OUVERTE => self::CIRCULATION_AVEC_BOUCHE_OU_GAINE_DESENFUMAGE_OUVERTE,
                TypeLnc::HALL_AVEC_FERMETURE_AUTOMATIQUE => self::HALL_AVEC_FERMETURE_AUTOMATIQUE,
                TypeLnc::HALL_SANS_FERMETURE_AUTOMATIQUE => self::HALL_SANS_FERMETURE_AUTOMATIQUE,
                TypeLnc::GARAGE_PRIVE_COLLECTIF => self::GARAGE_PRIVE_COLLECTIF,
                TypeLnc::AUTRES => self::AUTRES_DEPENDANCES,
                TypeLnc::LOCAL_NON_CHAUFFE_NON_ACCESSIBLE => self::LOCAL_NON_CHAUFFE_NON_ACCESSIBLE,
            };
        }
        return match ($mitoyennete) {
            Mitoyennete::EXTERIEUR => self::EXTERIEUR,
            Mitoyennete::PAROI_ENTERREE => self::PAROI_ENTERREE,
            Mitoyennete::VIDE_SANITAIRE => self::VIDE_SANITAIRE,
            Mitoyennete::BATIMENT_OU_LOCAL_HORS_HABITATION => self::BATIMENT_OU_LOCAL_HORS_HABITATION,
            Mitoyennete::TERRE_PLEIN => self::TERRE_PLEIN,
            Mitoyennete::SOUS_SOL_NON_CHAUFFEE => self::SOUS_SOL_NON_CHAUFFEE,
            Mitoyennete::LOCAL_TERTIAIRE_DANS_IMMEUBLE => self::LOCAL_TERTIAIRE_DANS_IMMEUBLE,
            Mitoyennete::LOCAL_NON_DEPERDITIF => self::LOCAL_NON_DEPERDITIF,
        };
    }

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::EXTERIEUR => 'Extérieur',
            self::PAROI_ENTERREE => 'Paroi enterrée',
            self::VIDE_SANITAIRE => 'Vide Sanitaire',
            self::BATIMENT_OU_LOCAL_HORS_HABITATION => 'Bâtiment ou local à usage autre que d\'habitation',
            self::TERRE_PLEIN => 'Terre-Plein',
            self::SOUS_SOL_NON_CHAUFFEE => 'Sous-sol non chauffé',
            self::LOCAL_NON_CHAUFFE_NON_ACCESSIBLE => 'Local non chauffé non accessible',
            self::GARAGE => 'Garage',
            self::CELLIER => 'Cellier',
            self::ESPACE_TAMPON_SOLARISE => 'Espace tampon solarisé (véranda,loggia fermée)',
            self::COMBLE_FORTEMENT_VENTILE => 'Comble fortement ventilé',
            self::COMBLE_FAIBLEMENT_VENTILE => 'Comble faiblement ventilé',
            self::COMBLE_TRES_FAIBLEMENT_VENTILE => 'Comble très faiblement ventilé',
            self::CIRCULATION_SANS_OUVERTURE_EXTERIEUR => 'Circulation sans ouverture directe sur l\'extérieur',
            self::CIRCULATION_AVEC_OUVERTURE_EXTERIEUR => 'Circulation avec ouverture directe sur l\'extérieur',
            self::CIRCULATION_AVEC_BOUCHE_OU_GAINE_DESENFUMAGE_OUVERTE => 'Circulation avec bouche ou gaine de désenfumage ouverte en permanence',
            self::HALL_AVEC_FERMETURE_AUTOMATIQUE => 'Hall d\'entrée avec dispositif de fermeture automatique',
            self::HALL_SANS_FERMETURE_AUTOMATIQUE => 'Hall d\'entrée sans dispositif de fermeture automatique',
            self::GARAGE_PRIVE_COLLECTIF => 'Garage privé collectif',
            self::LOCAL_TERTIAIRE_DANS_IMMEUBLE => 'Local tertiaire à l\'intérieur de l\'immeuble en contact avec l\'appartement',
            self::AUTRES_DEPENDANCES => 'Autres dépendances',
            self::LOCAL_NON_DEPERDITIF => 'Local non déperditif (local à usage d\'habitation chauffé)',
        };
    }
}
