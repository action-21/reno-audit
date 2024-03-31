<?php

namespace App\Domain\Batiment\ValueObject;

use App\Domain\Batiment\Enum\{ClasseAltitude, PeriodeConstruction};

/**
 * @property int $nombre_appartement - Nombre d'appartement
 * @property ClasseAltitude $classe_altitude - Classe d'altitude
 * @property PeriodeConstruction $periode_construction - Période de construction
 */
final class Caracteristique
{
    public function __construct(
        public readonly int $nombre_appartement,
        public readonly ClasseAltitude $classe_altitude,
        public readonly PeriodeConstruction $periode_construction,
    ) {
    }
}
