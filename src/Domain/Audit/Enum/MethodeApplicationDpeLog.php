<?php

namespace App\Domain\Audit\Enum;

use App\Domain\Batiment\Enum\TypeBatiment;
use App\Domain\Common\Enum\Enum;

enum MethodeApplicationDpeLog: int implements Enum
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
    case ID_12 = 12;
    case ID_13 = 13;
    case ID_14 = 14;
    case ID_15 = 15;
    case ID_16 = 16;
    case ID_17 = 17;
    case ID_18 = 18;
    case ID_19 = 19;
    case ID_20 = 20;
    case ID_21 = 21;
    case ID_22 = 22;
    case ID_23 = 23;
    case ID_24 = 24;
    case ID_25 = 25;
    case ID_26 = 26;
    case ID_27 = 27;
    case ID_28 = 28;
    case ID_29 = 29;
    case ID_30 = 30;
    case ID_31 = 31;
    case ID_32 = 32;
    case ID_33 = 33;
    case ID_34 = 34;
    case ID_35 = 35;
    case ID_36 = 36;
    case ID_37 = 37;
    case ID_38 = 38;
    case ID_39 = 39;
    case ID_40 = 40;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'DPE maison individuelle',
            self::ID_02 => 'DPE appartement individuel chauffage individuel ecs individuel',
            self::ID_03 => 'DPE appartement individuel chauffage collectif ecs individuel',
            self::ID_04 => 'DPE appartement individuel chauffage individuel ecs collectif',
            self::ID_05 => 'DPE appartement individuel chauffage collectif ecs collectif',
            self::ID_06 => 'DPE immeuble collectif chauffage individuel ecs individuel',
            self::ID_07 => 'DPE immeuble collectif chauffage collectif ecs individuel',
            self::ID_08 => 'DPE immeuble collectif chauffage individuel ecs collectif',
            self::ID_09 => 'DPE immeuble collectif chauffage collectif ecs collectif',
            self::ID_10 => 'DPE appartement généré à partir des données DPE immeuble chauffage individuel ecs individuel',
            self::ID_11 => 'DPE appartement généré à partir des données DPE immeuble chauffage collectif ecs individuel',
            self::ID_12 => 'DPE appartement généré à partir des données DPE immeuble chauffage individuel ecs collectif',
            self::ID_13 => 'DPE appartement généré à partir des données DPE immeuble chauffage collectif ecs collectif',
            self::ID_14 => 'DPE issu d\'une étude thermique réglementaire RT2012 bâtiment : maison individuelle',
            self::ID_15 => 'DPE issu d\'une étude thermique réglementaire RT2012 bâtiment : appartement chauffage collectif ecs collectif',
            self::ID_16 => 'DPE issu d\'une étude thermique réglementaire RT2012 bâtiment : appartement chauffage individuel ecs collectif',
            self::ID_17 => 'DPE issu d\'une étude thermique réglementaire RT2012 bâtiment : immeuble',
            self::ID_18 => 'DPE issu d\'une étude energie environement réglementaire RE2020 bâtiment : maison individuelle',
            self::ID_19 => 'DPE issu d\'une étude energie environement réglementaire RE2020 bâtiment : appartement chauffage collectif ecs collectif',
            self::ID_20 => 'DPE issu d\'une étude energie environement réglementaire RE2020 bâtiment : appartement chauffage individuel ecs collectif',
            self::ID_21 => 'DPE issu d\'une étude energie environement réglementaire RE2020 bâtiment : immeuble',
            self::ID_22 => 'DPE issu d\'une étude thermique réglementaire RT2012 bâtiment : appartement chauffage individuel ecs individuel',
            self::ID_23 => 'DPE issu d\'une étude thermique réglementaire RT2012 bâtiment : appartement chauffage collectif ecs individuel',
            self::ID_24 => 'DPE issu d\'une étude energie environement réglementaire RE2020 bâtiment : appartement chauffage collectif ecs individuel',
            self::ID_25 => 'DPE issu d\'une étude energie environement réglementaire RE2020 bâtiment : appartement chauffage individuel ecs individuel',
            self::ID_26 => 'DPE immeuble collectif chauffage mixte (collectif-individuel) ecs mixte (collectif-individuel)',
            self::ID_27 => 'DPE immeuble collectif chauffage mixte (collectif-individuel) ecs individuel',
            self::ID_28 => 'DPE immeuble collectif chauffage mixte (collectif-individuel) ecs collectif',
            self::ID_29 => 'DPE immeuble collectif chauffage individuel ecs mixte (collectif-individuel)',
            self::ID_30 => 'DPE immeuble collectif chauffage collectif ecs mixte (collectif-individuel)',
            self::ID_31 => 'DPE appartement individuel chauffage mixte (collectif-individuel) ecs individuel',
            self::ID_32 => 'DPE appartement individuel chauffage mixte (collectif-individuel) ecs collectif',
            self::ID_33 => 'DPE appartement généré à partir des données DPE immeuble chauffage mixte (collectif-individuel) ecs individuel',
            self::ID_34 => 'DPE appartement généré à partir des données DPE immeuble chauffage mixte (collectif-individuel) ecs collectif',
            self::ID_35 => 'DPE appartement individuel chauffage mixte (collectif-individuel) ecs mixte (collectif-individuel)',
            self::ID_36 => 'DPE appartement individuel chauffage individuel ecs mixte (collectif-individuel)',
            self::ID_37 => 'DPE appartement individuel chauffage collectif ecs mixte (collectif-individuel)',
            self::ID_38 => 'DPE appartement généré à partir des données DPE immeuble chauffage mixte (collectif-individuel) ecs mixte (collectif-individuel)',
            self::ID_39 => 'DPE appartement généré à partir des données DPE immeuble chauffage individuel ecs mixte (collectif-individuel)',
            self::ID_40 => 'DPE appartement généré à partir des données DPE immeuble chauffage collectif ecs mixte (collectif-individuel)'
        };
    }

    public function type_batiment(): TypeBatiment
    {
        return match ($this) {
            self::ID_01 => TypeBatiment::ID_01,
            self::ID_02 => TypeBatiment::ID_02,
            self::ID_03 => TypeBatiment::ID_02,
            self::ID_04 => TypeBatiment::ID_02,
            self::ID_05 => TypeBatiment::ID_02,
            self::ID_06 => TypeBatiment::ID_03,
            self::ID_07 => TypeBatiment::ID_03,
            self::ID_08 => TypeBatiment::ID_03,
            self::ID_09 => TypeBatiment::ID_03,
            self::ID_10 => TypeBatiment::ID_02,
            self::ID_11 => TypeBatiment::ID_02,
            self::ID_12 => TypeBatiment::ID_02,
            self::ID_13 => TypeBatiment::ID_02,
            self::ID_14 => TypeBatiment::ID_01,
            self::ID_15 => TypeBatiment::ID_02,
            self::ID_16 => TypeBatiment::ID_02,
            self::ID_17 => TypeBatiment::ID_03,
            self::ID_18 => TypeBatiment::ID_01,
            self::ID_19 => TypeBatiment::ID_02,
            self::ID_20 => TypeBatiment::ID_02,
            self::ID_21 => TypeBatiment::ID_03,
            self::ID_22 => TypeBatiment::ID_02,
            self::ID_23 => TypeBatiment::ID_02,
            self::ID_24 => TypeBatiment::ID_02,
            self::ID_25 => TypeBatiment::ID_02,
            self::ID_26 => TypeBatiment::ID_03,
            self::ID_27 => TypeBatiment::ID_03,
            self::ID_28 => TypeBatiment::ID_03,
            self::ID_29 => TypeBatiment::ID_03,
            self::ID_30 => TypeBatiment::ID_03,
            self::ID_31 => TypeBatiment::ID_02,
            self::ID_32 => TypeBatiment::ID_02,
            self::ID_33 => TypeBatiment::ID_02,
            self::ID_34 => TypeBatiment::ID_02,
            self::ID_35 => TypeBatiment::ID_02,
            self::ID_36 => TypeBatiment::ID_02,
            self::ID_37 => TypeBatiment::ID_02,
            self::ID_38 => TypeBatiment::ID_02,
            self::ID_39 => TypeBatiment::ID_02,
            self::ID_40 => TypeBatiment::ID_02
        };
    }

    public function type_batiment_source(): TypeBatiment
    {
        return match ($this) {
            self::ID_01 => TypeBatiment::ID_01,
            self::ID_02 => TypeBatiment::ID_02,
            self::ID_03 => TypeBatiment::ID_02,
            self::ID_04 => TypeBatiment::ID_02,
            self::ID_05 => TypeBatiment::ID_02,
            self::ID_06 => TypeBatiment::ID_03,
            self::ID_07 => TypeBatiment::ID_03,
            self::ID_08 => TypeBatiment::ID_03,
            self::ID_09 => TypeBatiment::ID_03,
            self::ID_10 => TypeBatiment::ID_03,
            self::ID_11 => TypeBatiment::ID_03,
            self::ID_12 => TypeBatiment::ID_03,
            self::ID_13 => TypeBatiment::ID_03,
            self::ID_14 => TypeBatiment::ID_01,
            self::ID_15 => TypeBatiment::ID_02,
            self::ID_16 => TypeBatiment::ID_02,
            self::ID_17 => TypeBatiment::ID_03,
            self::ID_18 => TypeBatiment::ID_01,
            self::ID_19 => TypeBatiment::ID_02,
            self::ID_20 => TypeBatiment::ID_02,
            self::ID_21 => TypeBatiment::ID_03,
            self::ID_22 => TypeBatiment::ID_02,
            self::ID_23 => TypeBatiment::ID_02,
            self::ID_24 => TypeBatiment::ID_02,
            self::ID_25 => TypeBatiment::ID_02,
            self::ID_26 => TypeBatiment::ID_03,
            self::ID_27 => TypeBatiment::ID_03,
            self::ID_28 => TypeBatiment::ID_03,
            self::ID_29 => TypeBatiment::ID_03,
            self::ID_30 => TypeBatiment::ID_03,
            self::ID_31 => TypeBatiment::ID_02,
            self::ID_32 => TypeBatiment::ID_02,
            self::ID_33 => TypeBatiment::ID_03,
            self::ID_34 => TypeBatiment::ID_03,
            self::ID_35 => TypeBatiment::ID_02,
            self::ID_36 => TypeBatiment::ID_02,
            self::ID_37 => TypeBatiment::ID_02,
            self::ID_38 => TypeBatiment::ID_03,
            self::ID_39 => TypeBatiment::ID_03,
            self::ID_40 => TypeBatiment::ID_03
        };
    }
}
