<?php

namespace App\Domain\Paroi\Enum;

use App\Domain\Common\Enum\Enum;

enum QualiteComposant: int implements Enum
{
    case TRES_BONNE = 1;
    case BONNE = 2;
    case MOYENNE = 3;
    case INSUFFISANTE = 4;

    public static function from_ubat(float $ubat): self
    {
        return match (true) {
            $ubat > 0.85 => self::INSUFFISANTE,
            $ubat > 0.65 => self::MOYENNE,
            $ubat > 0.45 => self::BONNE,
            $ubat <= 0.45 => self::TRES_BONNE,
        };
    }

    public static function from_ubaie(float $ubaie): self
    {
        return match (true) {
            $ubaie >= 3 => self::INSUFFISANTE,
            $ubaie >= 2.2 => self::MOYENNE,
            $ubaie >= 1.6 => self::BONNE,
            $ubaie < 1.6 => self::TRES_BONNE,
        };
    }

    public static function from_umur(float $umur): self
    {
        return match (true) {
            $umur >= 0.65 => self::INSUFFISANTE,
            $umur >= 0.45 => self::MOYENNE,
            $umur >= 0.3 => self::BONNE,
            $umur < 0.3 => self::TRES_BONNE,
        };
    }

    public static function from_upb(float $upb): self
    {
        return match (true) {
            $upb >= 0.65 => self::INSUFFISANTE,
            $upb >= 0.45 => self::MOYENNE,
            $upb >= 0.25 => self::BONNE,
            $upb < 0.25 => self::TRES_BONNE,
        };
    }

    public static function from_uph(float $uph): self
    {
        return match (true) {
            $uph >= 0.3 => self::INSUFFISANTE,
            $uph >= 0.2 => self::MOYENNE,
            $uph >= 0.15 => self::BONNE,
            $uph < 0.15 => self::TRES_BONNE,
        };
    }

    public static function from_uporte(float $value): self
    {
        return match (true) {
            $value >= 3 => self::INSUFFISANTE,
            $value >= 2.2 => self::MOYENNE,
            $value >= 1.6 => self::BONNE,
            $value < 1.6 => self::TRES_BONNE,
        };
    }

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::TRES_BONNE => 'Très bonne',
            self::BONNE => 'Bonne',
            self::MOYENNE => 'Moyenne',
            self::INSUFFISANTE => 'Insuffisante'
        };
    }
}
