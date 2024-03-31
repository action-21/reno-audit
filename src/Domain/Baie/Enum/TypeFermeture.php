<?php

namespace App\Domain\Baie\Enum;

use App\Domain\Common\Enum\Enum;

enum TypeFermeture: int implements Enum
{
    case ID_01 = 1;
    case ID_02 = 2;
    case ID_03 = 3;
    case ID_04 = 4;
    case ID_05 = 5;
    case ID_06 = 6;
    case ID_07 = 7;
    case ID_08 = 8;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Abscence de fermeture pour la baie vitrée',
            self::ID_02 => 'Jalousie accordéon, fermeture à lames orientables y compris les vénitiens extérieurs tout métal, volets battants ou persiennes avec ajours fixes',
            self::ID_03 => 'Fermeture sans ajours en position déployée, volets roulants alu',
            self::ID_04 => 'Volets roulants PVC ou bois (e inf 12 mm)',
            self::ID_05 => 'Persienne coulissante et volet battant PVC ou bois (e inf 22 mm)',
            self::ID_06 => 'Volets roulants PVC ou bois (e sup 12 mm)',
            self::ID_07 => 'Persienne coulissante et volet battant PVC ou bois (e sup 22 mm)',
            self::ID_08 => 'Fermeture isolée sans ajours en position déployée'
        };
    }

    /**
     * ΔR - Résistance thermique additionnelle due à la présence de volets aux fenêtres et portes-fenêtres ((m2.K/W))
     * 
     * @see §3.3.3
     */
    public function deltar(): ?float
    {
        return match ($this) {
            self::ID_02 =>  0.08,
            self::ID_03 => 0.15,
            self::ID_04 => 0.19,
            self::ID_05 => 0.19,
            self::ID_06 => 0.25,
            self::ID_07 => 0.25,
            self::ID_08 => 0.25,
            default => null
        };
    }
}
