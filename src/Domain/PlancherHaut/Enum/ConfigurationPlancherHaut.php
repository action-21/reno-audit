<?php

namespace App\Domain\PlancherHaut\Enum;

use App\Domain\Common\Enum\Enum;
use App\Domain\Lnc\Enum\TypeLnc;

enum ConfigurationPlancherHaut: int implements Enum
{
    case COMBLES_PERDUS = 1;
    case COMBLES_HABITABLES = 2;
    case TOITURE_TERRASSE = 3;

    /*
    public static function from_type_adjacence(TypeAdjacence $type_adjacence): self
    {
        return match ($type_adjacence) {
            TypeAdjacence::ID_04 => self::ID_02,
            TypeAdjacence::ID_07 => self::ID_02,
            TypeAdjacence::ID_09 => self::ID_01,
            TypeAdjacence::ID_10 => self::ID_01,
            TypeAdjacence::ID_11 => self::ID_01,
            TypeAdjacence::ID_12 => self::ID_01,
            TypeAdjacence::ID_13 => self::ID_01,
            TypeAdjacence::ID_14 => self::ID_02,
            TypeAdjacence::ID_15 => self::ID_02,
            TypeAdjacence::ID_16 => self::ID_02,
            TypeAdjacence::ID_19 => self::ID_02,
            TypeAdjacence::ID_20 => self::ID_02,
            TypeAdjacence::ID_21 => self::ID_02,
            TypeAdjacence::ID_22 => self::ID_01,
            default => self::ID_01
        };
    }
    */
    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::COMBLES_PERDUS => 'Combles perdus',
            self::COMBLES_HABITABLES => 'Combles habitables',
            self::TOITURE_TERRASSE => 'Toiture terrasse',
        };
    }

    public function local_non_chauffe_applicable(TypeLnc $type_lnc): bool
    {
        return match ($this) {
            self::COMBLES_PERDUS => $type_lnc->applicable_combles_perdus(),
            self::COMBLES_HABITABLES => $type_lnc->applicable_combles_habitables(),
            self::TOITURE_TERRASSE => $type_lnc->applicable_toiture_terrasse(),
        };
    }
}
