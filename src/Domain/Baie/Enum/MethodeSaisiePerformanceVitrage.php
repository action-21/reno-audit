<?php

namespace App\Domain\Baie\Enum;

use App\Domain\Common\Enum\Enum;

enum MethodeSaisiePerformanceVitrage: int implements Enum
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

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::ID_01 => 'Ug(opt),Uw,Ujn(opt) et Sw saisi à l\'aide des tables de valeurs forfaitaires et des relèves mesurées/observées',
            self::ID_02 => 'Ug saisi directementà partir des documents justificatifs autorisés, autres paramètres calculés avec les tables forfaitaires',
            self::ID_03 => 'Ug,Uw saisi directement à partir des documents justificatifs autorisés, autres paramètres calculés avec les tables forfaitaires',
            self::ID_04 => 'Ug,Uw,Sw saisi directement à partir des documents justificatifs autorisés, Ujn calculés avec les tables forfaitaires',
            self::ID_05 => 'Ug,Uw,Ujn saisi directement à partir des documents justificatifs autorisés, autres paramètres calculés avec les tables forfaitaires',
            self::ID_06 => 'Ug,Uw,Sw,Ujn saisi directement à partir des documents justificatifs autorisés',
            self::ID_07 => 'Ujn, Sw recalculés depuis RSET/RSEE( etude RT2012/RE2020)',
            self::ID_08 => 'Uw,Sw saisi directement à partir des documents justificatifs autorisés , Ujn calculés avec les tables forfaitaires',
            self::ID_09 => 'Uw,Ujn saisi directement à partir des documents justificatifs autorisés , Sw calculés avec les tables forfaitaires',
            self::ID_10 => 'Uw,Ujn, Sw saisi directement à partir des documents justificatifs autorisés',
            self::ID_11 => 'Ujn, Sw saisi directement à partir des documents justificatifs autorisés',
            self::ID_12 => 'Ujn saisi directement à partir des documents justificatifs autorisés, Sw calculés avec les tables forfaitaires',
            self::ID_13 => 'Uw saisi directement à partir des documents justificatifs autorisés, Ujn,Sw calculés avec les tables forfaitaires',
            self::ID_14 => 'Sw saisi directement à partir des documents justificatifs autorisés, Ujn,Uw calculés avec les tables forfaitaires',
            self::ID_15 => 'Ug,Sw saisi directement à partir des documents justificatifs autorisés, Ujn,Uw calculés avec les tables forfaitaires'
        };
    }
}
