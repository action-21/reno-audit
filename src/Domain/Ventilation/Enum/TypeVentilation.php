<?php

namespace App\Domain\Ventilation\Enum;

use App\Domain\Common\Enum\Enum;
use App\Domain\Audit\Enum\TypeEnergie;

enum TypeVentilation: int implements Enum
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

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Ventilation par ouverture des fenêtres',
            self::ID_02 => 'Ventilation par entrées d\'air hautes et basses',
            self::ID_03 => 'VMC SF Auto réglable avant 1982',
            self::ID_04 => 'VMC SF Auto réglable de 1982 à 2000',
            self::ID_05 => 'VMC SF Auto réglable de 2001 à 2012',
            self::ID_06 => 'VMC SF Auto réglable après 2012',
            self::ID_07 => 'VMC SF Hygro A avant 2001',
            self::ID_08 => 'VMC SF Hygro A de 2001 à 2012',
            self::ID_09 => 'VMC SF Hygro A après 2012',
            self::ID_10 => 'VMC SF Gaz avant  2001',
            self::ID_11 => 'VMC SF Gaz de 2001 à 2012',
            self::ID_12 => 'VMC SF Gaz après 2012',
            self::ID_13 => 'VMC SF Hygro B avant  2001',
            self::ID_14 => 'VMC SF Hygro B de 2001 à 2012',
            self::ID_15 => 'VMC SF Hygro B après 2012',
            self::ID_16 => 'VMC Basse pression Auto-réglable',
            self::ID_17 => 'VMC Basse pression Hygro A',
            self::ID_18 => 'VMC Basse pression Hygro B',
            self::ID_19 => 'VMC DF individuelle avec échangeur avant 2013',
            self::ID_20 => 'VMC DF individuelle avec échangeur à partir de 2013',
            self::ID_21 => 'VMC DF collective avec échangeur avant 2013',
            self::ID_22 => 'VMC DF collective avec échangeur à partir de 2013',
            self::ID_23 => 'VMC DF sans échangeur avant 2013',
            self::ID_24 => 'VMC DF sans échangeur après 2012',
            self::ID_25 => 'Ventilation naturelle par conduit',
            self::ID_26 => 'Ventilation hybride avant  2001',
            self::ID_27 => 'Ventilation hybride de 2001 à 2012',
            self::ID_28 => 'Ventilation hybride après 2012',
            self::ID_29 => 'Ventilation hybride avec entrées d\'air hygro avant  2001',
            self::ID_30 => 'Ventilation hybride avec entrées d\'air hygro de 2001 à 2012',
            self::ID_31 => 'Ventilation hybride avec entrées d\'air hygro après 2012',
            self::ID_32 => 'Ventilation mécanique sur conduit existant avant 2013',
            self::ID_33 => 'Ventilation mécanique sur conduit existant à partir de 2013',
            self::ID_34 => 'Ventilation naturelle par conduit avec entrées d\'air hygro',
            self::ID_35 => 'Puits climatique sans échangeur avant 2013',
            self::ID_36 => 'Puits climatique sans échangeur à partir de 2013',
            self::ID_37 => 'Puits climatique avec échangeur avant 2013',
            self::ID_38 => 'Puits climatique avec échangeur à partir de 2013'
        };
    }

    /**
     * Type d'énergie du système de ventilation
     */
    public function type_energie(): ?TypeEnergie
    {
        return match ($this) {
            self::ID_03 => TypeEnergie::ID_01,
            self::ID_04 => TypeEnergie::ID_01,
            self::ID_05 => TypeEnergie::ID_01,
            self::ID_06 => TypeEnergie::ID_01,
            self::ID_07 => TypeEnergie::ID_01,
            self::ID_08 => TypeEnergie::ID_01,
            self::ID_09 => TypeEnergie::ID_01,
            self::ID_10 => TypeEnergie::ID_01,
            self::ID_11 => TypeEnergie::ID_01,
            self::ID_12 => TypeEnergie::ID_01,
            self::ID_13 => TypeEnergie::ID_01,
            self::ID_14 => TypeEnergie::ID_01,
            self::ID_15 => TypeEnergie::ID_01,
            self::ID_16 => TypeEnergie::ID_01,
            self::ID_17 => TypeEnergie::ID_01,
            self::ID_18 => TypeEnergie::ID_01,
            self::ID_19 => TypeEnergie::ID_01,
            self::ID_20 => TypeEnergie::ID_01,
            self::ID_21 => TypeEnergie::ID_01,
            self::ID_22 => TypeEnergie::ID_01,
            self::ID_23 => TypeEnergie::ID_01,
            self::ID_24 => TypeEnergie::ID_01,
            self::ID_26 => TypeEnergie::ID_01,
            self::ID_27 => TypeEnergie::ID_01,
            self::ID_28 => TypeEnergie::ID_01,
            self::ID_29 => TypeEnergie::ID_01,
            self::ID_30 => TypeEnergie::ID_01,
            self::ID_31 => TypeEnergie::ID_01,
            self::ID_32 => TypeEnergie::ID_01,
            self::ID_33 => TypeEnergie::ID_01,
            default => null
        };
    }

    /**
     * Ratio d'utilisation applicable
     * 
     * @see §5
     */
    public function ratio_temps_utilisation(): bool
    {
        return match ($this) {
            self::ID_26 => true,
            self::ID_27 => true,
            self::ID_28 => true,
            self::ID_29 => true,
            self::ID_30 => true,
            self::ID_31 => true,
            default => false
        };
    }

    /**
     * Puissance moyenne des auxiliaires (W/(m³/h))
     */
    public function pvent_moy(): float
    {
        return match($this)
        {
            self::ID_01 => 0,
            self::ID_02 => 0,
            self::ID_03 => 65,
            self::ID_04 => 65,
            self::ID_05 => 65,
            self::ID_06 => 35,
            self::ID_07 => 50,
            self::ID_08 => 50,
            self::ID_09 => 15,
            self::ID_10 => 50,
            self::ID_11 => 50,
            self::ID_12 => 15,
            self::ID_13 => 50,
            self::ID_14 => 50,
            self::ID_15 => 15,
            self::ID_16 => 65,
            self::ID_17 => 50,
            self::ID_18 => 50,
            self::ID_19 => 80,
            self::ID_20 => 35,
            self::ID_21 => 0,
            self::ID_22 => 0,
            self::ID_23 => 80,
            self::ID_24 => 35,
            self::ID_25 => 0,
            self::ID_26 => 65,
            self::ID_27 => 65,
            self::ID_28 => 65,
            self::ID_29 => 65,
            self::ID_30 => 65,
            self::ID_31 => 65,
            self::ID_32 => 0,
            self::ID_33 => 0,
            self::ID_34 => 0,
            self::ID_35 => 0,
            self::ID_36 => 0,
            self::ID_37 => 0,
            self::ID_38 => 0
        };
    }

    /**
     * Puissance des auxiliaires (W/(m³/h))
     */
    public function pvent(): float
    {
        return match($this)
        {
            self::ID_01 => 0,
            self::ID_02 => 0,
            self::ID_03 => 0.46,
            self::ID_04 => 0.46,
            self::ID_05 => 0.46,
            self::ID_06 => 0.25,
            self::ID_07 => 0,
            self::ID_08 => 0,
            self::ID_09 => 0.25,
            self::ID_10 => 0.46,
            self::ID_11 => 0.46,
            self::ID_12 => 0.25,
            self::ID_13 => 0.46,
            self::ID_14 => 0.46,
            self::ID_15 => 0.25,
            self::ID_16 => 0.46,
            self::ID_17 => 0.46,
            self::ID_18 => 0.46,
            self::ID_19 => 1.1,
            self::ID_20 => 0.6,
            self::ID_21 => 1.1,
            self::ID_22 => 0.6,
            self::ID_23 => 1.1,
            self::ID_24 => 0.6,
            self::ID_25 => 0,
            self::ID_26 => 0.46,
            self::ID_27 => 0.46,
            self::ID_28 => 0.46,
            self::ID_29 => 0.46,
            self::ID_30 => 0.46,
            self::ID_31 => 0.46,
            self::ID_32 => 0,
            self::ID_33 => 0,
            self::ID_34 => 0,
            self::ID_35 => 0,
            self::ID_36 => 0,
            self::ID_37 => 0,
            self::ID_38 => 0,
        };
    }
}
