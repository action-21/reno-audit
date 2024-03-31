<?php

namespace App\Domain\Batiment\Enum;

use App\Domain\Common\Enum\Enum;
use App\Domain\Paroi\Enum\{PeriodeIsolation, TypeIsolation};

enum PeriodeConstruction: int implements Enum
{
    case AVANT_1948 = 1;
    case ENTRE_1948_ET_1974 = 2;
    case ENTRE_1975_ET_1977 = 3;
    case ENTRE_1978_ET_1982 = 4;
    case ENTRE_1983_ET_1988 = 5;
    case ENTRE_1989_ET_2000 = 6;
    case ENTRE_2001_ET_2005 = 7;
    case ENTRE_2006_ET_2012 = 8;
    case ENTRE_2013_ET_2021 = 9;
    case APRES_2021 = 10;

    public static function from_annee_construction(int $annee_construction): self
    {
        return match (true) {
            $annee_construction < 1948 => self::AVANT_1948,
            $annee_construction <= 1974 => self::ENTRE_1948_ET_1974,
            $annee_construction <= 1977 => self::ENTRE_1975_ET_1977,
            $annee_construction <= 1982 => self::ENTRE_1978_ET_1982,
            $annee_construction <= 1988 => self::ENTRE_1983_ET_1988,
            $annee_construction <= 2000 => self::ENTRE_1989_ET_2000,
            $annee_construction <= 2005 => self::ENTRE_2001_ET_2005,
            $annee_construction <= 2012 => self::ENTRE_2006_ET_2012,
            $annee_construction <= 2021 => self::ENTRE_2013_ET_2021,
            $annee_construction > 2021 => self::APRES_2021,
        };
    }

    public function id(): int
    {
        return $this->value;
    }

    public function lib(): string
    {
        return match ($this) {
            self::AVANT_1948 => 'Avant 1948',
            self::ENTRE_1948_ET_1974 => 'Entre 1948 et 1974',
            self::ENTRE_1975_ET_1977 => 'Entre 1975 et 1977',
            self::ENTRE_1978_ET_1982 => 'Entre 1978 et 1982',
            self::ENTRE_1983_ET_1988 => 'Entre 1983 et 1988',
            self::ENTRE_1989_ET_2000 => 'Entre 1989 et 2000',
            self::ENTRE_2001_ET_2005 => 'Entre 2001 et 2005',
            self::ENTRE_2006_ET_2012 => 'Entre 2006 et 2012',
            self::ENTRE_2013_ET_2021 => 'Entre 2013 et 2021',
            self::APRES_2021 => 'Après 2021'
        };
    }


    public function type_isolation_mur_defaut(): TypeIsolation
    {
        return match ($this) {
            self::AVANT_1948 => TypeIsolation::NON_ISOLE,
            self::ENTRE_1948_ET_1974 => TypeIsolation::NON_ISOLE,
            self::ENTRE_1975_ET_1977 => TypeIsolation::ITI,
            self::ENTRE_1978_ET_1982 => TypeIsolation::ITI,
            self::ENTRE_1983_ET_1988 => TypeIsolation::ITI,
            self::ENTRE_1989_ET_2000 => TypeIsolation::ITI,
            self::ENTRE_2001_ET_2005 => TypeIsolation::ITI,
            self::ENTRE_2006_ET_2012 => TypeIsolation::ITI,
            self::ENTRE_2013_ET_2021 => TypeIsolation::ITI,
            self::APRES_2021 => TypeIsolation::ITI
        };
    }

    public function type_isolation_terre_plein_defaut(): TypeIsolation
    {
        return match ($this) {
            self::AVANT_1948 => TypeIsolation::NON_ISOLE,
            self::ENTRE_1948_ET_1974 => TypeIsolation::NON_ISOLE,
            self::ENTRE_1975_ET_1977 => TypeIsolation::NON_ISOLE,
            self::ENTRE_1978_ET_1982 => TypeIsolation::NON_ISOLE,
            self::ENTRE_1983_ET_1988 => TypeIsolation::NON_ISOLE,
            self::ENTRE_1989_ET_2000 => TypeIsolation::NON_ISOLE,
            self::ENTRE_2001_ET_2005 => TypeIsolation::ITE,
            self::ENTRE_2006_ET_2012 => TypeIsolation::ITE,
            self::ENTRE_2013_ET_2021 => TypeIsolation::ITE,
            self::APRES_2021 => TypeIsolation::ITE
        };
    }

    public function type_isolation_plancher_bas_defaut(): TypeIsolation
    {
        return match ($this) {
            self::AVANT_1948 => TypeIsolation::NON_ISOLE,
            self::ENTRE_1948_ET_1974 => TypeIsolation::NON_ISOLE,
            self::ENTRE_1975_ET_1977 => TypeIsolation::ITE,
            self::ENTRE_1978_ET_1982 => TypeIsolation::ITE,
            self::ENTRE_1983_ET_1988 => TypeIsolation::ITE,
            self::ENTRE_1989_ET_2000 => TypeIsolation::ITE,
            self::ENTRE_2001_ET_2005 => TypeIsolation::ITE,
            self::ENTRE_2006_ET_2012 => TypeIsolation::ITE,
            self::ENTRE_2013_ET_2021 => TypeIsolation::ITE,
            self::APRES_2021 => TypeIsolation::ITE
        };
    }

    public function type_isolation_plancher_haut_defaut(): TypeIsolation
    {
        return match ($this) {
            self::AVANT_1948 => TypeIsolation::NON_ISOLE,
            self::ENTRE_1948_ET_1974 => TypeIsolation::NON_ISOLE,
            self::ENTRE_1975_ET_1977 => TypeIsolation::ITE,
            self::ENTRE_1978_ET_1982 => TypeIsolation::ITE,
            self::ENTRE_1983_ET_1988 => TypeIsolation::ITE,
            self::ENTRE_1989_ET_2000 => TypeIsolation::ITE,
            self::ENTRE_2001_ET_2005 => TypeIsolation::ITE,
            self::ENTRE_2006_ET_2012 => TypeIsolation::ITE,
            self::ENTRE_2013_ET_2021 => TypeIsolation::ITE,
            self::APRES_2021 => TypeIsolation::ITE
        };
    }

    public function periode_isolation_mur_defaut(): PeriodeIsolation
    {
        return match ($this) {
            self::AVANT_1948 => PeriodeIsolation::ENTRE_1975_ET_1977,
            self::ENTRE_1948_ET_1974 => PeriodeIsolation::ENTRE_1975_ET_1977,
            self::ENTRE_1975_ET_1977 => PeriodeIsolation::ENTRE_1975_ET_1977,
            self::ENTRE_1978_ET_1982 => PeriodeIsolation::ENTRE_1978_ET_1982,
            self::ENTRE_1983_ET_1988 => PeriodeIsolation::ENTRE_1983_ET_1988,
            self::ENTRE_1989_ET_2000 => PeriodeIsolation::ENTRE_1989_ET_2000,
            self::ENTRE_2001_ET_2005 => PeriodeIsolation::ENTRE_2001_ET_2005,
            self::ENTRE_2006_ET_2012 => PeriodeIsolation::ENTRE_2006_ET_2012,
            self::ENTRE_2013_ET_2021 => PeriodeIsolation::ENTRE_2013_ET_2021,
            self::APRES_2021 => PeriodeIsolation::APRES_2021
        };
    }

    public function periode_isolation_plancher_bas_defaut(): PeriodeIsolation
    {
        return match ($this) {
            self::AVANT_1948 => PeriodeIsolation::ENTRE_1975_ET_1977,
            self::ENTRE_1948_ET_1974 => PeriodeIsolation::ENTRE_1975_ET_1977,
            self::ENTRE_1975_ET_1977 => PeriodeIsolation::ENTRE_1975_ET_1977,
            self::ENTRE_1978_ET_1982 => PeriodeIsolation::ENTRE_1978_ET_1982,
            self::ENTRE_1983_ET_1988 => PeriodeIsolation::ENTRE_1983_ET_1988,
            self::ENTRE_1989_ET_2000 => PeriodeIsolation::ENTRE_1989_ET_2000,
            self::ENTRE_2001_ET_2005 => PeriodeIsolation::ENTRE_2001_ET_2005,
            self::ENTRE_2006_ET_2012 => PeriodeIsolation::ENTRE_2006_ET_2012,
            self::ENTRE_2013_ET_2021 => PeriodeIsolation::ENTRE_2013_ET_2021,
            self::APRES_2021 => PeriodeIsolation::APRES_2021
        };
    }

    public function periode_isolation_plancher_haut_defaut(): PeriodeIsolation
    {
        return match ($this) {
            self::AVANT_1948 => PeriodeIsolation::ENTRE_1975_ET_1977,
            self::ENTRE_1948_ET_1974 => PeriodeIsolation::ENTRE_1975_ET_1977,
            self::ENTRE_1975_ET_1977 => PeriodeIsolation::ENTRE_1975_ET_1977,
            self::ENTRE_1978_ET_1982 => PeriodeIsolation::ENTRE_1978_ET_1982,
            self::ENTRE_1983_ET_1988 => PeriodeIsolation::ENTRE_1983_ET_1988,
            self::ENTRE_1989_ET_2000 => PeriodeIsolation::ENTRE_1989_ET_2000,
            self::ENTRE_2001_ET_2005 => PeriodeIsolation::ENTRE_2001_ET_2005,
            self::ENTRE_2006_ET_2012 => PeriodeIsolation::ENTRE_2006_ET_2012,
            self::ENTRE_2013_ET_2021 => PeriodeIsolation::ENTRE_2013_ET_2021,
            self::APRES_2021 => PeriodeIsolation::APRES_2021
        };
    }

    /**
     * Période d'installation des émetteurs de chauffage par défaut
     */
    /**public function periode_installation_emetteur_defaut(): PeriodeInstallationEmetteur
    {
        return match($this)
        {
            self::AVANT_1948 => PeriodeInstallationEmetteur::ID_01,
            self::ENTRE_1948_ET_1974 => PeriodeInstallationEmetteur::ID_01,
            self::ENTRE_1975_ET_1977 => PeriodeInstallationEmetteur::ID_01,
            self::ENTRE_1978_ET_1982 => PeriodeInstallationEmetteur::ID_01,
            self::ENTRE_1983_ET_1988 => PeriodeInstallationEmetteur::ID_02,
            self::ENTRE_1989_ET_2000 => PeriodeInstallationEmetteur::ID_02,
            self::ENTRE_2001_ET_2005 => PeriodeInstallationEmetteur::ID_03,
            self::ENTRE_2006_ET_2012 => PeriodeInstallationEmetteur::ID_03,
            self::ENTRE_2013_ET_2021 => PeriodeInstallationEmetteur::ID_03,
            self::APRES_2021 => PeriodeInstallationEmetteur::ID_03
        };
    }*/
}
