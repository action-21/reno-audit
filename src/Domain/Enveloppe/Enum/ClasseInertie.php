<?php

namespace App\Domain\Envelopp\Enum;

use App\Domain\Common\Enum\Enum;

enum ClasseInertie: int implements Enum
{
    case TRES_LOURDE = 1;
    case LOURDE = 2;
    case MOYENNE = 3;
    case LEGERE = 4;

    public function id(): int
    {
        return $this->value;
    }

    public static function fromInertieParois(
        bool $plancher_bas_lourd,
        bool $plancher_haut_lourd,
        bool $paroi_verticale_lourd,
    ): self {
        return match (true) {
            $plancher_bas_lourd && $plancher_haut_lourd && $paroi_verticale_lourd => self::TRES_LOURDE,
            !$plancher_bas_lourd && $plancher_haut_lourd && $paroi_verticale_lourd => self::LOURDE,
            $plancher_bas_lourd && !$plancher_haut_lourd && $paroi_verticale_lourd => self::LOURDE,
            $plancher_bas_lourd && $plancher_haut_lourd && !$paroi_verticale_lourd => self::LOURDE,
            !$plancher_bas_lourd && !$plancher_haut_lourd && $paroi_verticale_lourd => self::MOYENNE,
            !$plancher_bas_lourd && $plancher_haut_lourd && !$paroi_verticale_lourd => self::MOYENNE,
            $plancher_bas_lourd && !$plancher_haut_lourd && !$paroi_verticale_lourd => self::MOYENNE,
            !$plancher_bas_lourd && !$plancher_haut_lourd && !$paroi_verticale_lourd => self::LEGERE,
        };
    }

    /**
     * @param self[] $collection
     */
    public static function tryFromCollection(array $collection): ?self
    {
        $collection = \array_unique($collection);

        if (\count($collection) === 0) {
            return null;
        }
        if (\count($collection) === 1) {
            return \reset($collection);
        }
        return match (false) {
            \in_array(self::LEGERE, $collection) => self::LOURDE,
            \in_array(self::MOYENNE, $collection) => self::MOYENNE,
            \in_array(self::LOURDE, $collection) => self::MOYENNE,
            \in_array(self::TRES_LOURDE, $collection) => self::MOYENNE,
        };
    }

    public function lib(): string
    {
        return match ($this) {
            self::TRES_LOURDE => 'Très lourde',
            self::LOURDE => 'Lourde',
            self::MOYENNE => 'Moyenne',
            self::LEGERE => 'Légère',
        };
    }

    public function lourde(): bool
    {
        return match ($this) {
            self::TRES_LOURDE => true,
            self::LOURDE => true,
            default => false
        };
    }

    /**
     * Exposant utilisé pour le calcul des apports gratuits
     */
    public function exposant(): float
    {
        return match ($this) {
            self::TRES_LOURDE, self::LOURDE => 3.6,
            self::MOYENNE => 2.9,
            self::LEGERE => 2.5,
        };
    }

    /**
     * Cin - Capacité thermique intérieure efficace de la zone (J/K)
     */
    public function cin(): float
    {
        return match ($this) {
            self::TRES_LOURDE, self::LOURDE => 260000,
            self::MOYENNE => 165000,
            self::LEGERE => 110000,
        };
    }
}
