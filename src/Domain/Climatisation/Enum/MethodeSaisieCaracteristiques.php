<?php

namespace App\Domain\Climatisation\Enum;

use App\Domain\Common\Enum\Enum;

enum MethodeSaisieCaracteristiques: int implements Enum
{
    case ID_01 = 1;
    case ID_02 = 2;
    case ID_04 = 4;
    case ID_06 = 6;
    case ID_07 = 7;
    case ID_08 = 8;

    /** @deprecated */
    case ID_03 = 3;
    /** @deprecated */
    case ID_05 = 5;

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Valeurs forfaitaires',
            self::ID_02 => 'Caractéristiques saisies à partir de la plaque signalétique ou d\'une documentation technique du système à combustion : Pn, autres données forfaitaires',
            self::ID_03 => 'Caractéristiques saisies à partir de la plaque signalétique ou d\'une documentation technique du système à combustion : Pn, Rpn,Rpint, autres données forfaitaires',
            self::ID_04 => 'Caractéristiques saisies à partir de la plaque signalétique ou d\'une documentation technique du système à combustion : Pn, Rpn,Rpint,Qp0, autres données forfaitaires',
            self::ID_05 => 'Caractéristiques saisies à partir de la plaque signalétique ou d\'une documentation technique du système à combustion : Pn, Rpn,Rpint,Qp0,temp_fonc_30,temp_fonc_100',
            self::ID_06 => 'Caractéristiques saisies à partir de la plaque signalétique ou d\'une documentation technique du système thermodynamique : SCOP/COP/EER',
            self::ID_07 => 'Déterminé à partir du RSET/RSEE( etude RT2012/RE2020)',
            self::ID_08 => 'SEER saisi pour permettre la saisie de réseau de froid ou de système de climatisations qui ne sont pas éléctriques'
        };
    }
}
