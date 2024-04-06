<?php

namespace App\Domain\Enveloppe\Enum;

use App\Domain\Common\Enum\Enum;

/**
 * @see https://www.legifrance.gouv.fr/download/pdf?id=doxMrRr0wbfJVvtWjfDP4qE7zNsiFZL-4wqNyqoY-CA=
 */
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
