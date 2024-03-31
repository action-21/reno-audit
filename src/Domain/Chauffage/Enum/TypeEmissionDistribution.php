<?php

namespace App\Domain\Chauffage\Enum;

enum TypeEmissionDistribution: int
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

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Convecteur électrique NFC, NF** et NF***',
            self::ID_02 => 'Panneau rayonnant NFC, NF** et NF***',
            self::ID_03 => 'Radiateur électrique NFC, NF** et NF***',
            self::ID_04 => 'Autres émetteurs à effet joule',
            self::ID_05 => 'Soufflage d\'air chaud (air soufflé) avec distribution par réseau aéraulique',
            self::ID_06 => 'Plafond rayonnant électrique avec régulation terminale',
            self::ID_07 => 'Plafond rayonnant électrique sans régulation',
            self::ID_08 => 'Plancher rayonnant électrique avec régulation terminale',
            self::ID_09 => 'Plancher rayonnant électrique sans régulation',
            self::ID_10 => 'Radiateur électrique à accumulation',
            self::ID_11 => 'Plancher chauffant sur réseau collectif eau chaude haute température(sup ou egal 65°C)',
            self::ID_12 => 'Plancher chauffant sur réseau collectif eau chaude basse ou moyenne température(inf 65°C)',
            self::ID_13 => 'Plancher chauffant sur réseau individuel eau chaude haute température(sup ou egal 65°C)',
            self::ID_14 => 'Plancher chauffant sur réseau individuel eau chaude basse ou moyenne température(inf 65°C)',
            self::ID_15 => 'Plafond chauffant sur réseau collectif eau chaude haute température(sup ou egal 65°C)',
            self::ID_16 => 'Plafond chauffant sur réseau collectif eau chaude basse ou moyenne température(inf 65°C)',
            self::ID_17 => 'Plafond chauffant sur réseau individuel eau chaude haute température(sup ou egal 65°C)',
            self::ID_18 => 'Plafond chauffant sur réseau individuel eau chaude basse ou moyenne température(inf 65°C)',
            self::ID_19 => 'Radiateur gaz à ventouse ou sur conduit de fumée',
            self::ID_20 => 'Poêle charbon',
            self::ID_21 => 'Poêle bois',
            self::ID_22 => 'Poêle fioul',
            self::ID_23 => 'Poêle GPL',
            self::ID_24 => 'Radiateur monotube sans robinet thermostatique sur réseau collectif eau chaude haute température(sup ou egal 65°C)',
            self::ID_25 => 'Radiateur monotube sans robinet thermostatique sur réseau collectif eau chaude basse ou moyenne température(inf 65°C)',
            self::ID_26 => 'Radiateur monotube sans robinet thermostatique sur réseau individuel eau chaude haute température(sup ou egal 65°C)',
            self::ID_27 => 'Radiateur monotube sans robinet thermostatique sur réseau individuel eau chaude basse ou moyenne température(inf 65°C)',
            self::ID_28 => 'Radiateur monotube avec robinet thermostatique sur réseau collectif eau chaude haute température(sup ou egal 65°C)',
            self::ID_29 => 'Radiateur monotube avec robinet thermostatique sur réseau collectif eau chaude basse ou moyenne température(inf 65°C)',
            self::ID_30 => 'Radiateur monotube avec robinet thermostatique sur réseau individuel eau chaude haute température(sup ou egal 65°C)',
            self::ID_31 => 'Radiateur monotube avec robinet thermostatique sur réseau individuel eau chaude basse ou moyenne température(inf 65°C)',
            self::ID_32 => 'Radiateur bitube sans robinet thermostatique sur réseau collectif eau chaude haute température(sup ou egal 65°C)',
            self::ID_33 => 'Radiateur bitube sans robinet thermostatique sur réseau collectif eau chaude basse ou moyenne température(inf 65°C)',
            self::ID_34 => 'Radiateur bitube sans robinet thermostatique sur réseau individuel eau chaude haute température(sup ou egal 65°C)',
            self::ID_35 => 'Radiateur bitube sans robinet thermostatique sur réseau individuel eau chaude basse ou moyenne température(inf 65°C)',
            self::ID_36 => 'Radiateur bitube avec robinet thermostatique sur réseau collectif eau chaude haute température(sup ou egal 65°C)',
            self::ID_37 => 'Radiateur bitube avec robinet thermostatique sur réseau collectif eau chaude basse ou moyenne température(inf 65°C)',
            self::ID_38 => 'Radiateur bitube avec robinet thermostatique sur réseau individuel eau chaude haute température(sup ou egal 65°C)',
            self::ID_39 => 'Radiateur bitube avec robinet thermostatique sur réseau individuel eau chaude basse ou moyenne température(inf 65°C)',
            self::ID_40 => 'Convecteur bi-jonction',
            self::ID_41 => 'Autres équipements',
            self::ID_42 => 'Soufflage d\'air chaud (air soufflé) avec distribution par fluide frigorigène',
            self::ID_43 => 'Plancher chauffant avec distribution par fluide frigorigène (plancher chauffant à détente directe)',
            self::ID_44 => 'Plafond chauffant avec distribution par fluide frigorigène (Plafond chauffant à détente directe)',
            self::ID_45 => 'Radiateur avec distribution par fluide frigorigène (à détente directe)',
            self::ID_46 => 'Soufflage d\'air chaud (Ventiloconvecteur) sur réseau collectif eau chaude haute température(sup ou egal 65°C)',
            self::ID_47 => 'Soufflage d\'air chaud (Ventiloconvecteur) sur réseau collectif eau chaude basse ou moyenne température(inf 65°C)',
            self::ID_48 => 'Soufflage d\'air chaud (Ventiloconvecteur) sur réseau individuel eau chaude haute température(sup ou egal 65°C)',
            self::ID_49 => 'Soufflage d\'air chaud (Ventiloconvecteur) sur réseau individuel eau chaude basse ou moyenne température(inf 65°C)',
            self::ID_50 => 'Soufflage d\'air chaud sans réseau de distribution (ventiloconvecteur éléctrique)'
        };
    }

    /**
     * rd - Rendement de distribution de chauffage
     * 
     * @see §12.2
     */
    public function rd(): float
    {
        return match ($this) {
            self::ID_01 => 0.99,
            self::ID_02 => 0.99,
            self::ID_03 => 0.99,
            self::ID_04 => 0.96,
            self::ID_05 => 0.96,
            self::ID_06 => 0.98,
            self::ID_08 => 0.98,
            self::ID_07 => 0.96,
            self::ID_09 => 0.96,
            self::ID_10 => 0.95,
            self::ID_11 => 0.9,
            self::ID_12 => 0.9,
            self::ID_13 => 0.95,
            self::ID_14 => 0.95,
            self::ID_15 => 0.9,
            self::ID_16 => 0.9,
            self::ID_17 => 0.95,
            self::ID_18 => 0.95,
            self::ID_19 => 0.96,
            self::ID_20 => 0.8,
            self::ID_21 => 0.8,
            self::ID_22 => 0.8,
            self::ID_23 => 0.8,
            self::ID_24 => 0.9,
            self::ID_25 => 0.9,
            self::ID_26 => 0.9,
            self::ID_27 => 0.9,
            self::ID_28 => 0.95,
            self::ID_29 => 0.95,
            self::ID_30 => 0.95,
            self::ID_31 => 0.95,
            self::ID_32 => 0.9,
            self::ID_33 => 0.9,
            self::ID_34 => 0.9,
            self::ID_35 => 0.9,
            self::ID_36 => 0.95,
            self::ID_37 => 0.95,
            self::ID_38 => 0.95,
            self::ID_39 => 0.95,
            self::ID_40 => 0.9,
            self::ID_41 => 0.9,
            self::ID_42 => 0.96,
            self::ID_43 => 0.9,
            self::ID_44 => 0.9,
            self::ID_45 => 0.9,
            self::ID_46 => 0.96,
            self::ID_47 => 0.96,
            self::ID_48 => 0.96,
            self::ID_49 => 0.96,
            self::ID_50 => 0.96
        };
    }

    public function effet_joule(): bool
    {
        return match ($this) {
            self::ID_01 => true,
            self::ID_02 => true,
            self::ID_03 => true,
            self::ID_04 => true,
            self::ID_05 => true,
            self::ID_06 => true,
            self::ID_07 => true,
            self::ID_08 => true,
            self::ID_09 => true,
            self::ID_10 => true,
            self::ID_40 => true,
            self::ID_50 => true,
            default => false
        };
    }
}
