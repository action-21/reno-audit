<?php

namespace App\Domain\Lnc\Enum;

use App\Domain\Common\Enum\Enum;
use App\Domain\Paroi\Enum\{TypeAdjacence, TypeParoi};

enum TypeLnc: int implements Enum
{
    case GARAGE = 1;
    case CELLIER = 2;
    case ESPACE_TAMPON_SOLARISE = 3;
    case COMBLE_FORTEMENT_VENTILE = 4;
    case COMBLE_FAIBLEMENT_VENTILE = 5;
    case COMBLE_TRES_FAIBLEMENT_VENTILE = 6;
    case CIRCULATION_SANS_OUVERTURE_EXTERIEUR = 7;
    case CIRCULATION_AVEC_OUVERTURE_EXTERIEUR = 8;
    case CIRCULATION_AVEC_BOUCHE_OU_GAINE_DESENFUMAGE_OUVERTE = 9;
    case HALL_AVEC_FERMETURE_AUTOMATIQUE = 10;
    case HALL_SANS_FERMETURE_AUTOMATIQUE = 11;
    case GARAGE_PRIVE_COLLECTIF = 12;
    case AUTRES = 13;
    case LOCAL_NON_CHAUFFE_NON_ACCESSIBLE = 14;

    public static function create_from(TypeAdjacence $type_adjacence): ?self
    {
        return match ($type_adjacence) {
            TypeAdjacence::GARAGE => self::GARAGE,
            TypeAdjacence::CELLIER => self::CELLIER,
            TypeAdjacence::ESPACE_TAMPON_SOLARISE => self::ESPACE_TAMPON_SOLARISE,
            TypeAdjacence::COMBLE_FORTEMENT_VENTILE => self::COMBLE_FORTEMENT_VENTILE,
            TypeAdjacence::COMBLE_FAIBLEMENT_VENTILE => self::COMBLE_FAIBLEMENT_VENTILE,
            TypeAdjacence::COMBLE_TRES_FAIBLEMENT_VENTILE => self::COMBLE_TRES_FAIBLEMENT_VENTILE,
            TypeAdjacence::CIRCULATION_SANS_OUVERTURE_EXTERIEUR => self::CIRCULATION_SANS_OUVERTURE_EXTERIEUR,
            TypeAdjacence::CIRCULATION_AVEC_OUVERTURE_EXTERIEUR => self::CIRCULATION_AVEC_OUVERTURE_EXTERIEUR,
            TypeAdjacence::CIRCULATION_AVEC_BOUCHE_OU_GAINE_DESENFUMAGE_OUVERTE => self::CIRCULATION_AVEC_BOUCHE_OU_GAINE_DESENFUMAGE_OUVERTE,
            TypeAdjacence::HALL_AVEC_FERMETURE_AUTOMATIQUE => self::HALL_AVEC_FERMETURE_AUTOMATIQUE,
            TypeAdjacence::HALL_SANS_FERMETURE_AUTOMATIQUE => self::HALL_SANS_FERMETURE_AUTOMATIQUE,
            TypeAdjacence::GARAGE_PRIVE_COLLECTIF => self::GARAGE_PRIVE_COLLECTIF,
            TypeAdjacence::AUTRES_DEPENDANCES => self::AUTRES,
            TypeAdjacence::LOCAL_NON_CHAUFFE_NON_ACCESSIBLE => self::LOCAL_NON_CHAUFFE_NON_ACCESSIBLE,
        };
    }

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::GARAGE => 'Garage',
            self::CELLIER => 'Cellier',
            self::ESPACE_TAMPON_SOLARISE => 'Espace tampon solarisé (véranda ou loggia fermée)',
            self::COMBLE_FORTEMENT_VENTILE => 'Comble fortement ventilé',
            self::COMBLE_FAIBLEMENT_VENTILE => 'Comble faiblement ventilé',
            self::COMBLE_TRES_FAIBLEMENT_VENTILE => 'Comble très faiblement ventilé',
            self::CIRCULATION_SANS_OUVERTURE_EXTERIEUR => 'Circulation sans ouverture directe sur l\'extérieur',
            self::CIRCULATION_AVEC_OUVERTURE_EXTERIEUR => 'Circulation avec ouverture directe sur l\'extérieur',
            self::CIRCULATION_AVEC_BOUCHE_OU_GAINE_DESENFUMAGE_OUVERTE => 'Circulation avec bouche ou gaine de désenfumage ouverte en permanence',
            self::HALL_AVEC_FERMETURE_AUTOMATIQUE => 'Hall d\'entrée avec dispositif de fermeture automatique',
            self::HALL_SANS_FERMETURE_AUTOMATIQUE => 'Hall d\'entrée sans dispositif de fermeture automatique',
            self::GARAGE_PRIVE_COLLECTIF => 'Garage privé collectif',
            self::AUTRES => 'Autres dépendances',
            self::LOCAL_NON_CHAUFFE_NON_ACCESSIBLE => 'Local non chauffé non accessible',
        };
    }

    public function applicable(TypeParoi $type_paroi): bool
    {
        return match ($this) {
            self::GARAGE => \in_array($type_paroi, [TypeParoi::MUR, TypeParoi::PLANCHER_BAS, TypeParoi::BAIE, TypeParoi::PORTE]),
            self::COMBLE_FORTEMENT_VENTILE => \in_array($type_paroi, [TypeParoi::MUR, TypeParoi::PLANCHER_HAUT]),
            self::COMBLE_FAIBLEMENT_VENTILE => \in_array($type_paroi, [TypeParoi::MUR, TypeParoi::PLANCHER_HAUT]),
            self::COMBLE_TRES_FAIBLEMENT_VENTILE => \in_array($type_paroi, [TypeParoi::MUR, TypeParoi::PLANCHER_HAUT]),
            self::HALL_AVEC_FERMETURE_AUTOMATIQUE => \in_array($type_paroi, [TypeParoi::MUR, TypeParoi::PLANCHER_BAS, TypeParoi::BAIE, TypeParoi::PORTE]),
            self::HALL_SANS_FERMETURE_AUTOMATIQUE => \in_array($type_paroi, [TypeParoi::MUR, TypeParoi::PLANCHER_BAS, TypeParoi::BAIE, TypeParoi::PORTE]),
            self::GARAGE_PRIVE_COLLECTIF => \in_array($type_paroi, [TypeParoi::MUR, TypeParoi::PLANCHER_BAS, TypeParoi::BAIE, TypeParoi::PORTE]),
            default => true,
        };
    }

    public function applicable_combles_perdus(): bool
    {
        return match ($this) {
            self::COMBLE_FORTEMENT_VENTILE => true,
            self::COMBLE_FAIBLEMENT_VENTILE => true,
            self::COMBLE_TRES_FAIBLEMENT_VENTILE => true,
            self::LOCAL_NON_CHAUFFE_NON_ACCESSIBLE => true,
            default => $this->applicable(TypeParoi::PLANCHER_HAUT),
        };
    }

    public function applicable_combles_habitables(): bool
    {
        return $this->applicable(TypeParoi::PLANCHER_HAUT);
    }

    public function applicable_toiture_terrasse(): bool
    {
        return match ($this) {
            self::COMBLE_FORTEMENT_VENTILE => false,
            self::COMBLE_FAIBLEMENT_VENTILE => false,
            self::COMBLE_TRES_FAIBLEMENT_VENTILE => false,
            default => $this->applicable(TypeParoi::PLANCHER_HAUT),
        };
    }
}
