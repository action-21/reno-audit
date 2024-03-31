# Locaux non chauffés (LNC)

Prise en compte des locaux non chauffés pour la détermination des coefficient de réduction des déperditions et des apports solaires.

## Usage

```
use App\Domain\Lnc\Lnc;
use App\Domain\Lnc\MasqueLointainBuilder;
use App\Domain\MasqueLointain\Enum\Orientation;

$builder = new MasqueLointainBuilder;
$builder->create(batiment: $batiment, description: 'Un masque proche');
$entity = $builder->
$entity = $builder->setFondBalconOuFondFlancLoggias(avancee: 2, orientation: Orientation::SUD);
$entity = $builder->setBalconOuAuvent(avancee: 2);
$entity = $builder->setParoiLaterale(obstacle_au_sud: true);
```

## Modélisation

```mermaid
classDiagram
    class Lnc {
        + string reference
        + Batiment batiment
        + string description
        + TypeLnc type_lnc
        + collection baie_collection
        + collection paroi_collection
        + create(Batiment batiment, string description, TypeLnc type_lnc) self
        + update(string description, TypeLnc type_lnc) self
    }
    class Paroi {
        + string reference
        + Lnc lnc
        + string description
        + float surface
        + bool isolation
        + create(Lnc lnc, string description, float surface, bool isolation) self
        + update(string description, float surface, bool isolation) self
    }
    class Baie {
        + string reference
        + Lnc lnc
        + string description
        + float surface
        + ?bool vitrage_vir
        + Orientation orientation
        + MateriauxMenuiserie type_materiaux_menuiserie
        + ?TypeVitrage type_vitrage
        + InclinaisonVitrage inclinaison_vitrage
        + public function update(string description, float surface, Orientation orientation, MateriauxMenuiserie type_materiaux_menuiserie, InclinaisonVitrage inclinaison_vitrage) self
        + setBaie(TypeVitrage type_vitrage, bool vitrage_vir) self
        + setBaiePolycarbonate(?TypeVitrage type_vitrage = null, ?bool vitrage_vir = null) self
    }
    class Orientation {
        <<enumeration>>
        SUD = 1
        NORD = 2
        EST = 3
        OUEST = 4
        HORIZONTAL = 5
    }
    class InclinaisonVitrage {
        <<enumeration>>
        INFERIEUR_25 = 1
        ENTRE_25_ET_75 = 2
        SUPERIEUR_75 = 3
        HORIZONTAL = 4
    }
    class MateriauxMenuiserie {
        <<enumeration>>
        BRIQUE_VERRE = 1
        POLYCARBONATE = 2
        BOIS = 3
        BOIS_METAL = 4
        PVC = 5
        METAL_AVEC_RUPTEUR_PONT_THERMIQUE = 6
        METAL_SANS_RUPTEUR_PONT_THERMIQUE = 7
    }
    class TypeLnc {
        <<enumeration>>
        GARAGE = 1
        CELLIER = 2
        ESPACE_TAMPON_SOLARISE = 3
        COMBLE_FORTEMENT_VENTILE = 4
        COMBLE_FAIBLEMENT_VENTILE = 5
        COMBLE_TRES_FAIBLEMENT_VENTILE = 6
        CIRCULATION_SANS_OUVERTURE_EXTERIEUR = 7
        CIRCULATION_AVEC_OUVERTURE_EXTERIEUR = 8
        CIRCULATION_AVEC_BOUCHE_OU_GAINE_DESENFUMAGE_OUVERTE = 9
        HALL_AVEC_FERMETURE_AUTOMATIQUE = 10
        HALL_SANS_FERMETURE_AUTOMATIQUE = 11
        GARAGE_PRIVE_COLLECTIF = 12
        AUTRES = 13
    }
    class TypeVitrage {
        <<enumeration>>
        SIMPLE_VITRAGE = 1
        DOUBLE_VITRAGE = 2
        TRIPLE_VITRAGE = 3
        SURVITRAGE = 4
        BRIQUE_VERRE = 5
        POLYCARBONATE = 6
    }
    class Batiment {
        lnc_collection() collection
    }
    Lnc --o TypeLnc : aggregation
    Baie --o Orientation : aggregation
    Baie --o InclinaisonVitrage : aggregation
    Baie --o MateriauxMenuiserie : aggregation
    Baie --o TypeVitrage : aggregation
    Batiment "1" o--o "0..n" Lnc
    Lnc "1" o--o "0..n" Paroi
    Lnc "1" o--o "0..n" Baie
```

## Opendata

### Cas des espaces tampons solarisés

Les espaces tampons solarisés peuvent être déduites de la valeur `tv_coef_transparence_ets_id` de chaque `ets` en complement des données d'entrée `baie_ets`.

### Cas des autres locaux non chauffés

Le modèle open data n'impose pas une description des locaux non chauffés. Ces données sont donc déduites des valeurs de `tv_coef_reduction_deperdition_id` :

1. Récupération de toutes les valeurs uniques `enum_type_lnc_id` et `isolation_aue` des lignes `tv_b` correspondant à `tv_coef_reduction_deperdition_id`
2. Pour chaque valeur de `tv_b` trouvé, on recherche l'ensemble des parois correspondantes
3. Pour chaque valeur de `tv_b` trouvé, création d'un LNC sur la base des colones `enum_type_lnc_id`,  `isolation_aue` et `aiu_aue_defaut`

## Remarques

### Définition d'un espace tampon solarisé

La méthode 3CL-DPE n'offre pas de définition d'un espace tampon solarisé. Il est proposé d'indiquer un taux de surface vitrée donnant sur l'extérieur au delà duquel un local non chauffé doit être considéré comme un espace tampon solarisé.
