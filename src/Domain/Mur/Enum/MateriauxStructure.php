<?php

namespace App\Domain\Mur\Enum;

use App\Domain\Common\Enum\Enum;

/**
 * TODO: renomage des énumérations
 */
enum MateriauxStructure: int implements Enum
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
    case ID_24 = 24;
    case ID_25 = 25;
    case ID_26 = 26;
    case ID_27 = 27;

    /** @deprecated */
    case ID_21 = 21;
    /** @deprecated */
    case ID_22 = 22;
    /** @deprecated */
    case ID_23 = 23;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Inconnu',
            self::ID_02 => 'Murs en pierre de taille et moellons constitué d\'un seul matériaux',
            self::ID_03 => 'Murs en pierre de taille et moellons avec remplissage tout venant',
            self::ID_04 => 'Murs en pisé ou béton de terre stabilisé (à partir d\'argile crue)',
            self::ID_05 => 'Murs en pan de bois sans remplissage tout venant',
            self::ID_06 => 'Murs en pan de bois avec remplissage tout venant',
            self::ID_07 => 'Murs bois (rondin)',
            self::ID_08 => 'Murs en briques pleines simples',
            self::ID_09 => 'Murs en briques pleines doubles avec lame d\'air',
            self::ID_10 => 'Murs en briques creuses',
            self::ID_11 => 'Murs en blocs de béton pleins',
            self::ID_12 => 'Murs en blocs de béton creux',
            self::ID_13 => 'Murs en béton banché',
            self::ID_14 => 'Murs en béton de mâchefer',
            self::ID_15 => 'Brique terre cuite alvéolaire',
            self::ID_16 => 'Béton cellulaire avant 2013',
            self::ID_17 => 'Béton cellulaire à partir de 2013',
            self::ID_18 => 'Murs en ossature bois avec isolant en remplissage ≥ 2006',
            self::ID_19 => 'Murs sandwich béton/isolant/béton (sans isolation rapportée)',
            self::ID_20 => 'Cloison de plâtre',
            self::ID_21 => 'Autre matériau traditionel ancien',
            self::ID_22 => 'Autre matériau innovant récent',
            self::ID_23 => 'Autre matériau non répertorié',
            self::ID_24 => 'Murs en ossature bois avec isolant en remplissage 2001-2005',
            self::ID_25 => 'Murs en ossature bois sans remplissage',
            self::ID_26 => 'Murs en ossature bois avec isolant en remplissage <2001',
            self::ID_27 => 'Murs en ossature bois avec remplissage tout venant'
        };
    }

    public function inconnu(): bool
    {
        return $this === self::ID_01;
    }
}
