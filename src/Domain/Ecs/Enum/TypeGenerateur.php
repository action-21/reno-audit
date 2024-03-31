<?php

namespace App\Domain\Ecs\Enum;

enum TypeGenerateur: int
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
    case ID_41 = 41;
    case ID_42 = 42;
    case ID_43 = 43;
    case ID_44 = 44;
    case ID_45 = 45;
    case ID_46 = 46;
    case ID_47 = 47;
    case ID_48 = 48;
    case ID_49 = 49;
    case ID_50 = 50;
    case ID_51 = 51;
    case ID_52 = 52;

    public static function defaut(int $type_generateur_ecs): ?self
    {
        return match ($type_generateur_ecs) {
            1 => self::ID_01,
            2 => self::ID_01,
            3 => self::ID_01,
            4 => self::ID_02,
            5 => self::ID_02,
            6 => self::ID_02,
            7 => self::ID_03,
            8 => self::ID_03,
            9 => self::ID_03,
            10 => self::ID_04,
            11 => self::ID_04,
            12 => self::ID_04,
            13 => self::ID_05,
            14 => self::ID_05,
            15 => self::ID_06,
            16 => self::ID_06,
            17 => self::ID_06,
            18 => self::ID_06,
            19 => self::ID_06,
            20 => self::ID_06,
            21 => self::ID_06,
            22 => self::ID_07,
            23 => self::ID_07,
            24 => self::ID_07,
            25 => self::ID_07,
            26 => self::ID_07,
            27 => self::ID_07,
            28 => self::ID_07,
            29 => self::ID_08,
            30 => self::ID_08,
            31 => self::ID_08,
            32 => self::ID_08,
            33 => self::ID_08,
            34 => self::ID_08,
            35 => self::ID_09,
            36 => self::ID_09,
            37 => self::ID_09,
            38 => self::ID_09,
            39 => self::ID_09,
            40 => self::ID_09,
            41 => self::ID_10,
            42 => self::ID_10,
            43 => self::ID_11,
            44 => self::ID_11,
            45 => self::ID_12,
            46 => self::ID_12,
            47 => self::ID_12,
            48 => self::ID_12,
            49 => self::ID_12,
            50 => self::ID_12,
            51 => self::ID_13,
            52 => self::ID_13,
            53 => self::ID_13,
            54 => self::ID_14,
            55 => self::ID_14,
            56 => self::ID_14,
            57 => self::ID_14,
            58 => self::ID_15,
            59 => self::ID_15,
            60 => self::ID_15,
            61 => self::ID_16,
            62 => self::ID_16,
            63 => self::ID_17,
            64 => self::ID_17,
            65 => self::ID_17,
            66 => self::ID_17,
            67 => self::ID_17,
            68 => self::ID_18,
            69 => self::ID_19,
            70 => self::ID_20,
            71 => self::ID_21,
            72 => self::ID_22,
            73 => self::ID_23,
            74 => self::ID_24,
            75 => self::ID_25,
            76 => self::ID_26,
            77 => self::ID_27,
            78 => self::ID_28,
            79 => self::ID_29,
            80 => self::ID_30,
            81 => self::ID_31,
            82 => self::ID_32,
            83 => self::ID_33,
            84 => self::ID_34,
            85 => self::ID_35,
            86 => self::ID_35,
            87 => self::ID_35,
            88 => self::ID_35,
            89 => self::ID_35,
            90 => self::ID_35,
            91 => self::ID_35,
            92 => self::ID_36,
            93 => self::ID_36,
            94 => self::ID_36,
            95 => self::ID_36,
            96 => self::ID_36,
            97 => self::ID_36,
            98 => self::ID_37,
            99 => self::ID_37,
            100 => self::ID_37,
            101 => self::ID_38,
            102 => self::ID_38,
            103 => self::ID_38,
            104 => self::ID_38,
            105 => self::ID_39,
            106 => self::ID_39,
            107 => self::ID_39,
            108 => self::ID_40,
            109 => self::ID_40,
            110 => self::ID_41,
            111 => self::ID_41,
            112 => self::ID_41,
            113 => self::ID_41,
            114 => self::ID_41,
            115 => self::ID_42,
            116 => self::ID_42,
            117 => self::ID_43,
            118 => self::ID_44,
            119 => self::ID_45,
            120 => self::ID_46,
            121 => self::ID_46,
            122 => self::ID_47,
            123 => self::ID_47,
            124 => self::ID_48,
            125 => self::ID_48,
            126 => self::ID_49,
            127 => self::ID_49,
            128 => self::ID_49,
            129 => self::ID_50,
            130 => self::ID_50,
            131 => self::ID_50,
            132 => self::ID_51,
            133 => self::ID_51,
            134 => self::ID_52,
            default => null
        };
    }

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'CET sur air ambiant (sur local non chauffé)',
            self::ID_02 => 'CET sur air extérieur',
            self::ID_03 => 'CET sur air extrait',
            self::ID_04 => 'PAC double service',
            self::ID_05 => 'Poêle à bois bouilleur bûche',
            self::ID_06 => 'Chaudière bois bûche',
            self::ID_07 => 'Chaudière bois plaquette',
            self::ID_08 => 'Chaudière bois granulés',
            self::ID_09 => 'Chaudière fioul standard',
            self::ID_10 => 'Chaudière fioul basse température',
            self::ID_11 => 'Chaudière fioul à condensation',
            self::ID_12 => 'Chaudière gaz standard',
            self::ID_13 => 'Chaudière gaz basse température',
            self::ID_14 => 'Chaudière gaz à condensation',
            self::ID_15 => 'Accumulateur gaz classique',
            self::ID_16 => 'Accumulateur gaz à condensation',
            self::ID_17 => 'Chauffe-eau gaz à production instantanée',
            self::ID_18 => 'Ballon électrique à accumulation horizontal',
            self::ID_19 => 'Ballon électrique à accumulation vertical - Autres ou inconnue',
            self::ID_20 => 'Ballon électrique à accumulation vertical - Catégorie B ou 2 étoiles',
            self::ID_21 => 'Ballon électrique à accumulation vertical - Catégorie C ou 3 étoiles',
            self::ID_22 => 'Réseau de chaleur non isolé',
            self::ID_23 => 'Réseau de chaleur isolé',
            self::ID_24 => 'Chaudière(s) bois multi bâtiment modélisée comme un réseau de chaleur',
            self::ID_25 => 'Chaudière(s) fioul multi bâtiment modélisée comme un réseau de chaleur',
            self::ID_26 => 'Chaudière(s) gaz multi bâtiment modélisée comme un réseau de chaleur',
            self::ID_27 => 'Pompe(s) à chaleur multi bâtiment modélisée comme un réseau de chaleur',
            self::ID_28 => 'Autre système à combustion gaz',
            self::ID_29 => 'Autre système à combustion fioul',
            self::ID_30 => 'Autre système à combustion bois',
            self::ID_31 => 'Autre système à combustion autres energies fossiles (charbon,pétrole etc…)',
            self::ID_32 => 'Autre système thermodynamique électrique',
            self::ID_33 => 'Autre système thermodynamique gaz',
            self::ID_34 => 'Système collectif par défaut en abscence d\'information : chaudière fioul pénalisante',
            self::ID_35 => 'Chaudière charbon',
            self::ID_36 => 'Chaudière gpl/propane/butane standard',
            self::ID_37 => 'Chaudière gpl/propane/butane basse température',
            self::ID_38 => 'Chaudière gpl/propane/butane à condensation',
            self::ID_39 => 'Accumulateur gpl/propane/butane classique',
            self::ID_40 => 'Accumulateur gpl/propane/butane à condensation',
            self::ID_41 => 'Chauffe-eau gpl/propane/butane à production instantanée',
            self::ID_42 => 'Poêle à bois bouilleur granulés',
            self::ID_43 => 'Chauffe-eau électrique instantané',
            self::ID_44 => 'Chaudière électrique',
            self::ID_45 => 'Réseau de chaleur non répertorié ou inconnu',
            self::ID_46 => 'Pompe à chaleur hybride : partie chaudière Chaudière gaz à condensation',
            self::ID_47 => 'Pompe à chaleur hybride : partie chaudière Chaudière fioul à condensation',
            self::ID_48 => 'Pompe à chaleur hybride : partie chaudière Chaudière bois granulés',
            self::ID_49 => 'Pompe à chaleur hybride : partie chaudière Chaudière bois bûche',
            self::ID_50 => 'Pompe à chaleur hybride : partie chaudière Chaudière bois plaquette',
            self::ID_51 => 'Pompe à chaleur hybride : partie chaudière Chaudière gpl/propane/butane à condensation',
            self::ID_52 => 'Chaudière(s) charbon multi bâtiment modélisée comme un réseau de chaleur'
        };
    }

    public function position_probable_volume_chauffe(): ?bool
    {
        return match ($this) {
            self::ID_05 => true,
            self::ID_18 => true,
            self::ID_19 => true,
            self::ID_20 => true,
            self::ID_21 => true,
            self::ID_42 => true,
            self::ID_43 => true,
            self::ID_01 => false,
            self::ID_02 => false,
            self::ID_03 => false,
            self::ID_04 => false,
            self::ID_06 => false,
            self::ID_07 => false,
            self::ID_08 => false,
            self::ID_22 => false,
            self::ID_23 => false,
            self::ID_24 => false,
            self::ID_25 => false,
            self::ID_26 => false,
            self::ID_27 => false,
            self::ID_35 => false,
            self::ID_36 => false,
            self::ID_37 => false,
            self::ID_38 => false,
            self::ID_45 => false,
            self::ID_48 => false,
            self::ID_49 => false,
            self::ID_50 => false,
            self::ID_51 => false,
            default => null
        };
    }

    public function type_ballon_electrique_defaut(): ?TypeBallonElectrique
    {
        return match ($this) {
            self::ID_18 => TypeBallonElectrique::ID_01,
            self::ID_19 => TypeBallonElectrique::ID_02,
            self::ID_20 => TypeBallonElectrique::ID_03,
            self::ID_21 => TypeBallonElectrique::ID_04,
            default => null
        };
    }

    /**
     * Application du scénario de calcul dédié aux générateurs à combustion
     * 
     * @see 13
     */
    public function calcul_generateur_combustion(): bool
    {
        return match ($this) {
            self::ID_05 => true,
            self::ID_42 => true,
            self::ID_06 => true,
            self::ID_07 => true,
            self::ID_08 => true,
            self::ID_35 => true,
            self::ID_36 => true,
            self::ID_37 => true,
            self::ID_38 => true,
            self::ID_48 => true,
            self::ID_49 => true,
            self::ID_50 => true,
            self::ID_51 => true,
            self::ID_09 => true,
            self::ID_10 => true,
            self::ID_11 => true,
            self::ID_12 => true,
            self::ID_13 => true,
            self::ID_14 => true,
            self::ID_34 => true,
            self::ID_39 => true,
            self::ID_40 => true,
            self::ID_46 => true,
            self::ID_47 => true,
            default => false
        };
    }

    /**
     * Application du scénario de calcul dédié aux chauffe-eau gaz à production instantannée
     * 
     * @see 14.1.1
     */
    public function calcul_chauffe_eau_gaz(): bool
    {
        return match ($this) {
            self::ID_17 => true,
            self::ID_41 => true,
            default => false
        };
    }

    /**
     * Application du scénario de calcul dédié aux accumulateurs gaz
     * 
     * @see 14.1.3
     */
    public function calcul_accumulateur_gaz(): bool
    {
        return match ($this) {
            self::ID_15 => true,
            self::ID_16 => true,
            default => false
        };
    }

    /**
     * Application du scénario de calcul dédié aux chauffe-eau thermodynamique à accumulation
     * 
     * @see 14.2
     */
    public function calcul_chauffe_eau_thermodynamique(): bool
    {
        return match ($this) {
            self::ID_01 => true,
            self::ID_02 => true,
            self::ID_03 => true,
            self::ID_04 => true,
            default => false
        };
    }

    /**
     * Application du scénario de calcul dédié aux chauffe-eau électrique
     * 
     * @see 12.14.1
     */
    public function calcul_chauffe_eau_electrique(): bool
    {
        return match ($this) {
            self::ID_18 => true,
            self::ID_19 => true,
            self::ID_20 => true,
            self::ID_21 => true,
            self::ID_43 => true,
            self::ID_44 => true,
            default => false
        };
    }

    /**
     * Application du scénario de calcul dédié aux réseaux de chaleur
     * 
     * @see 14.3
     */
    public function calcul_reseau_chaleur(): bool
    {
        return match ($this) {
            self::ID_22 => true,
            self::ID_23 => true,
            self::ID_24 => true,
            self::ID_25 => true,
            self::ID_26 => true,
            self::ID_27 => true,
            self::ID_45 => true,
            self::ID_52 => true,
            default => false
        };
    }

    public function rendement_generation_effet_joule(): ?float
    {
        return match ($this) {
            self::ID_18 => 1,
            self::ID_19 => 1,
            self::ID_20 => 1,
            self::ID_21 => 1,
            self::ID_43 => 1,
            self::ID_44 => 0.97,
            default => null
        };
    }
}
