<?php

namespace App\Domain\Chauffage\Enum;

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
    case ID_53 = 53;
    case ID_54 = 54;
    case ID_55 = 55;
    case ID_56 = 56;
    case ID_57 = 57;
    case ID_58 = 58;
    case ID_59 = 59;
    case ID_60 = 60;
    case ID_61 = 61;
    case ID_62 = 62;
    case ID_63 = 63;
    case ID_64 = 64;
    case ID_65 = 65;
    case ID_66 = 66;
    case ID_67 = 67;
    case ID_68 = 68;
    case ID_69 = 69;
    case ID_70 = 70;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'PAC air/air',
            self::ID_02 => 'PAC air/eau',
            self::ID_03 => 'PAC eau/eau',
            self::ID_04 => 'PAC eau glycolée/eau',
            self::ID_05 => 'PAC géothermique',
            self::ID_06 => 'Cuisinière',
            self::ID_07 => 'Foyer fermé',
            self::ID_08 => 'Poêle bûche',
            self::ID_09 => 'Insert',
            self::ID_10 => 'Cuisinière flamme verte',
            self::ID_11 => 'Foyer fermé flamme verte',
            self::ID_12 => 'Poêle bûche flamme verte',
            self::ID_13 => 'Insert flamme verte',
            self::ID_14 => 'Poêle à granulés',
            self::ID_15 => 'Poêle à granulés flamme verte',
            self::ID_16 => 'Poêle fioul/GPL/charbon',
            self::ID_17 => 'Poêle à bois bouilleur bûche',
            self::ID_18 => 'Générateur à air chaud à combustion',
            self::ID_19 => 'Générateur à air chaud à combustion à condensation',
            self::ID_20 => 'Radiateur à gaz indépendant ou autonome',
            self::ID_21 => 'Chaudière bois bûche',
            self::ID_22 => 'Chaudière bois plaquette',
            self::ID_23 => 'Chaudière bois granulés',
            self::ID_24 => 'Chaudière fioul standard',
            self::ID_25 => 'Chaudière fioul basse température',
            self::ID_26 => 'Chaudière fioul à condensation',
            self::ID_27 => 'Chaudière gaz standard',
            self::ID_28 => 'Chaudière gaz basse température',
            self::ID_29 => 'Chaudière gaz à condensation',
            self::ID_30 => 'Convecteur électrique NFC, NF** et NF***',
            self::ID_31 => 'Panneau rayonnant électrique NFC, NF** et NF***',
            self::ID_32 => 'radiateur électrique NFC, NF** et NF***',
            self::ID_33 => 'Autres émetteurs à effet joule',
            self::ID_34 => 'Plancher ou plafond rayonnant électrique avec régulation terminale',
            self::ID_35 => 'Plancher ou plafond rayonnant électrique sans régulation terminale',
            self::ID_36 => 'Radiateur électrique à accumulation',
            self::ID_37 => 'convecteur bi-jonction',
            self::ID_38 => 'Chaudière électrique',
            self::ID_39 => 'Réseau de chaleur non isolé',
            self::ID_40 => 'Réseau de chaleur isolé',
            self::ID_41 => 'Chaudière(s) bois multi bâtiment modélisée comme un réseau de chaleur',
            self::ID_42 => 'Chaudière(s) fioul multi bâtiment modélisée comme un réseau de chaleur',
            self::ID_43 => 'Chaudière(s) gaz multi bâtiment modélisée comme un réseau de chaleur',
            self::ID_44 => 'Pompe(s) à chaleur multi bâtiment modélisée comme un réseau de chaleur',
            self::ID_45 => 'Autre système à combustion gaz',
            self::ID_46 => 'Autre système à combustion fioul',
            self::ID_47 => 'Autre système à combustion bois',
            self::ID_48 => 'Autre système à combustion autres energies fossiles (charbon,pétrole etc…)',
            self::ID_49 => 'Autre système thermodynamique électrique',
            self::ID_50 => 'Autre système thermodynamique gaz',
            self::ID_51 => 'Système collectif par défaut en abscence d\'information : chaudière fioul pénalisante',
            self::ID_52 => 'Chaudière charbon',
            self::ID_53 => 'Chaudière gpl/propane/butane standard',
            self::ID_54 => 'Chaudière gpl/propane/butane basse température',
            self::ID_55 => 'Chaudière gpl/propane/butane à condensation',
            self::ID_56 => 'Poêle à bois bouilleur granulés',
            self::ID_57 => 'Réseau de chaleur non répertorié ou inconnu',
            self::ID_58 => 'Pompe à chaleur hybride : partie pompe à chaleur (SUPPRIME)',
            self::ID_59 => 'Pompe à chaleur hybride : partie chaudière (SUPPRIME)',
            self::ID_60 => 'Pompe à chaleur hybride : partie pompe à chaleur - PAC air/eau',
            self::ID_61 => 'Pompe à chaleur hybride : partie chaudière - Chaudière gaz à condensation',
            self::ID_62 => 'Pompe à chaleur hybride : partie chaudière - Chaudière fioul à condensation',
            self::ID_63 => 'Pompe à chaleur hybride : partie chaudière  - Chaudière bois granulés',
            self::ID_64 => 'Pompe à chaleur hybride : partie chaudière  - Chaudière bois bûche',
            self::ID_65 => 'Pompe à chaleur hybride : partie chaudière  - Chaudière bois plaquette',
            self::ID_66 => 'Pompe à chaleur hybride : partie chaudière -  Chaudière gpl/propane/butane à condensation',
            self::ID_67 => 'Pompe à chaleur hybride : partie pompe à chaleur - PAC eau/eau',
            self::ID_68 => 'Pompe à chaleur hybride : partie pompe à chaleur - PAC eau glycolée/eau',
            self::ID_69 => 'Pompe à chaleur hybride : partie pompe à chaleur  - PAC géothermique',
            self::ID_70 => 'Chaudière(s) charbon multi bâtiment modélisée comme un réseau de chaleur'
        };
    }

    /**
     * Valeur par défaut pour l'importation des données XML de la base DPE - Pour les poêles à granulés, il n'est
     *      pas possible de distinguer les équipements avec ou sans label flamme verte (sans par défaut).
     */
    public static function defaut(int $enum_type_generateur_chauffage_id): ?self
    {
        return match ($enum_type_generateur_chauffage_id) {
            1 => self::ID_01,
            2 => self::ID_01,
            3 => self::ID_01,
            4 => self::ID_02,
            5 => self::ID_02,
            6 => self::ID_02,
            7 => self::ID_02,
            8 => self::ID_03,
            9 => self::ID_03,
            10 => self::ID_03,
            11 => self::ID_03,
            12 => self::ID_04,
            13 => self::ID_04,
            14 => self::ID_04,
            15 => self::ID_04,
            16 => self::ID_05,
            17 => self::ID_05,
            18 => self::ID_05,
            19 => self::ID_05,
            20 => self::ID_06,
            24 => self::ID_06,
            28 => self::ID_06,
            21 => self::ID_07,
            25 => self::ID_07,
            29 => self::ID_07,
            22 => self::ID_08,
            26 => self::ID_08,
            30 => self::ID_08,
            23 => self::ID_09,
            27 => self::ID_09,
            31 => self::ID_09,
            32 => self::ID_10,
            36 => self::ID_10,
            40 => self::ID_10,
            33 => self::ID_11,
            37 => self::ID_11,
            41 => self::ID_11,
            34 => self::ID_12,
            38 => self::ID_12,
            42 => self::ID_12,
            35 => self::ID_13,
            39 => self::ID_13,
            43 => self::ID_13,
            44 => self::ID_14,
            45 => self::ID_15,
            46 => self::ID_15,
            47 => self::ID_16,
            48 => self::ID_17,
            49 => self::ID_17,
            50 => self::ID_18,
            51 => self::ID_18,
            52 => self::ID_19,
            53 => self::ID_20,
            54 => self::ID_20,
            55 => self::ID_21,
            56 => self::ID_21,
            57 => self::ID_21,
            58 => self::ID_21,
            59 => self::ID_21,
            60 => self::ID_21,
            61 => self::ID_21,
            62 => self::ID_22,
            63 => self::ID_22,
            64 => self::ID_22,
            65 => self::ID_22,
            66 => self::ID_22,
            67 => self::ID_22,
            68 => self::ID_22,
            69 => self::ID_23,
            70 => self::ID_23,
            71 => self::ID_23,
            72 => self::ID_23,
            73 => self::ID_23,
            74 => self::ID_23,
            75 => self::ID_24,
            76 => self::ID_24,
            77 => self::ID_24,
            78 => self::ID_24,
            79 => self::ID_24,
            80 => self::ID_24,
            81 => self::ID_25,
            82 => self::ID_25,
            83 => self::ID_26,
            84 => self::ID_26,
            85 => self::ID_27,
            86 => self::ID_27,
            87 => self::ID_27,
            88 => self::ID_27,
            89 => self::ID_27,
            90 => self::ID_27,
            91 => self::ID_28,
            92 => self::ID_28,
            93 => self::ID_28,
            94 => self::ID_29,
            95 => self::ID_29,
            96 => self::ID_29,
            97 => self::ID_29,
            98 => self::ID_30,
            99 => self::ID_31,
            100 => self::ID_32,
            101 => self::ID_33,
            102 => self::ID_34,
            103 => self::ID_35,
            104 => self::ID_36,
            105 => self::ID_37,
            106 => self::ID_38,
            107 => self::ID_39,
            108 => self::ID_40,
            109 => self::ID_41,
            110 => self::ID_42,
            111 => self::ID_43,
            112 => self::ID_44,
            113 => self::ID_45,
            114 => self::ID_46,
            115 => self::ID_47,
            116 => self::ID_48,
            117 => self::ID_49,
            118 => self::ID_50,
            119 => self::ID_51,
            120 => self::ID_52,
            121 => self::ID_52,
            122 => self::ID_52,
            123 => self::ID_52,
            124 => self::ID_52,
            125 => self::ID_52,
            126 => self::ID_52,
            127 => self::ID_53,
            128 => self::ID_53,
            129 => self::ID_53,
            130 => self::ID_53,
            131 => self::ID_53,
            132 => self::ID_53,
            133 => self::ID_54,
            134 => self::ID_54,
            135 => self::ID_54,
            136 => self::ID_55,
            137 => self::ID_55,
            138 => self::ID_55,
            139 => self::ID_55,
            140 => self::ID_56,
            141 => self::ID_56,
            142 => self::ID_57,
            143 => self::ID_58,
            144 => self::ID_59,
            145 => self::ID_60,
            146 => self::ID_60,
            147 => self::ID_60,
            148 => self::ID_61,
            149 => self::ID_61,
            150 => self::ID_62,
            151 => self::ID_62,
            152 => self::ID_63,
            153 => self::ID_63,
            154 => self::ID_64,
            155 => self::ID_64,
            156 => self::ID_64,
            157 => self::ID_65,
            158 => self::ID_65,
            159 => self::ID_65,
            160 => self::ID_66,
            161 => self::ID_66,
            162 => self::ID_67,
            163 => self::ID_67,
            164 => self::ID_67,
            165 => self::ID_68,
            166 => self::ID_68,
            167 => self::ID_68,
            168 => self::ID_69,
            169 => self::ID_69,
            170 => self::ID_69,
            171 => self::ID_70,
            default => null
        };
    }

    /**
     * Calcul du rendement de génération pour les générateurs à combustion
     */
    public function calcul_combustion(): bool
    {
        return match ($this) {
            self::ID_17 => true,
            self::ID_18 => true,
            self::ID_19 => true,
            self::ID_20 => true,
            self::ID_21 => true,
            self::ID_22 => true,
            self::ID_23 => true,
            self::ID_24 => true,
            self::ID_25 => true,
            self::ID_26 => true,
            self::ID_27 => true,
            self::ID_28 => true,
            self::ID_29 => true,
            self::ID_45 => true,
            self::ID_46 => true,
            self::ID_47 => true,
            self::ID_48 => true,
            self::ID_51 => true,
            self::ID_52 => true,
            self::ID_53 => true,
            self::ID_54 => true,
            self::ID_55 => true,
            self::ID_56 => true,
            self::ID_59 => true,
            self::ID_61 => true,
            self::ID_62 => true,
            self::ID_63 => true,
            self::ID_64 => true,
            self::ID_65 => true,
            self::ID_66 => true,
            default => false
        };
    }

    /**
     * Calcul spécifique aux chaudières à condensation
     */
    public function calcul_chaudiere_condenstation(): bool
    {
        return match ($this) {
            self::ID_26 => true,
            self::ID_29 => true,
            self::ID_55 => true,
            self::ID_61 => true,
            self::ID_62 => true,
            self::ID_66 => true,
            default => false
        };
    }

    /**
     * Calcul spécifique aux chaudières basse température
     */
    public function calcul_chaudiere_basse_temperature(): bool
    {
        return match ($this) {
            self::ID_25 => true,
            self::ID_28 => true,
            self::ID_54 => true,
            default => false
        };
    }

    /**
     * Calcul spécifique aux chaudières standards au gaz / fioul
     */
    public function calcul_chaudiere_standard(): bool
    {
        return match ($this) {
            self::ID_24 => true,
            self::ID_27 => true,
            self::ID_51 => true,
            self::ID_53 => true,
            default => false
        };
    }

    /**
     * Calcul spécifique aux chaudières bois ou charbon (hors chaudières basse tepérature ou à condensation)
     */
    public function calcul_chaudiere_bois(): bool
    {
        return match ($this) {
            self::ID_17 => true,
            self::ID_21 => true,
            self::ID_22 => true,
            self::ID_23 => true,
            self::ID_52 => true,
            self::ID_56 => true,
            self::ID_63 => true,
            self::ID_64 => true,
            self::ID_65 => true,
            default => false
        };
    }

    /**
     * Calcul spécifique aux générateurs d'air chaud à combustion
     */
    public function calcul_generateur_air_chaud(): bool
    {
        return match ($this) {
            self::ID_18 => true,
            self::ID_19 => true,
            default => false
        };
    }

    /**
     * Calcul spécifique aux radiateurs à gaz
     */
    public function calcul_radiateur_gaz(): bool
    {
        return match ($this) {
            self::ID_20 => true,
            default => false
        };
    }

    public function rpn_sup_rpint(): ?bool
    {
        return match ($this) {
            self::ID_24 => true,
            self::ID_27 => true,
            self::ID_53 => true,
            default => null
        };
    }

    /**
     * Position probable du générateur en volume chauffé
     */
    public function position_probable_volume_chauffe(): ?bool
    {
        return match ($this) {
            self::ID_24 => false,
            self::ID_26 => false,
            self::ID_62 => false,
            self::ID_21 => false,
            self::ID_22 => false,
            self::ID_23 => false,
            self::ID_52 => false,
            self::ID_63 => false,
            self::ID_64 => false,
            self::ID_65 => false,
            self::ID_51 => false,
            self::ID_39 => false,
            self::ID_40 => false,
            self::ID_41 => false,
            self::ID_42 => false,
            self::ID_43 => false,
            self::ID_44 => false,
            self::ID_57 => false,
            self::ID_70 => false,
            self::ID_25 => false,
            self::ID_20 => true,
            self::ID_06 => true,
            self::ID_07 => true,
            self::ID_08 => true,
            self::ID_09 => true,
            self::ID_10 => true,
            self::ID_11 => true,
            self::ID_12 => true,
            self::ID_13 => true,
            self::ID_14 => true,
            self::ID_15 => true,
            self::ID_16 => true,
            self::ID_30 => true,
            self::ID_31 => true,
            self::ID_32 => true,
            self::ID_33 => true,
            self::ID_34 => true,
            self::ID_35 => true,
            self::ID_36 => true,
            self::ID_37 => true,
            default => null
        };
    }
}
