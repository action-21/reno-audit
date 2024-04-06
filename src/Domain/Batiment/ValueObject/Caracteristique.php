<?php

namespace App\Domain\Batiment\ValueObject;

use App\Domain\Batiment\Enum\{ClasseAltitude, PeriodeConstruction, TypeBatiment};

final class Caracteristique
{
    public function __construct(
        public readonly float $surface_habitable,
        public readonly ?int $nombre_appartement,
        public readonly TypeBatiment $type_batiment,
        public readonly ClasseAltitude $classe_altitude,
        public readonly PeriodeConstruction $periode_construction,
    ) {
    }

    /**
     * Caractéristiques d'une maison
     */
    public static function create_from_maison(
        float $surface_habitable,
        ClasseAltitude $classe_altitude,
        PeriodeConstruction $periode_construction,
    ): self {
        return new self(
            surface_habitable: $surface_habitable,
            nombre_appartement: null,
            type_batiment: TypeBatiment::MAISON,
            classe_altitude: $classe_altitude,
            periode_construction: $periode_construction,
        );
    }

    /**
     * Caractéristiques d'un appartement
     */
    public static function create_from_appartement(
        float $surface_habitable,
        ClasseAltitude $classe_altitude,
        PeriodeConstruction $periode_construction,
    ): self {
        return new self(
            surface_habitable: $surface_habitable,
            nombre_appartement: 1,
            type_batiment: TypeBatiment::APPARTEMENT,
            classe_altitude: $classe_altitude,
            periode_construction: $periode_construction,
        );
    }

    /**
     * Caractéristiques d'un immeuble
     */
    public static function create_from_immeuble(
        float $surface_habitable,
        int $nombre_appartement,
        ClasseAltitude $classe_altitude,
        PeriodeConstruction $periode_construction,
    ): self {
        return new self(
            surface_habitable: $surface_habitable,
            nombre_appartement: $nombre_appartement,
            type_batiment: TypeBatiment::IMMEUBLE,
            classe_altitude: $classe_altitude,
            periode_construction: $periode_construction,
        );
    }

    /**
     * Surface habitable moyenne (m²)
     */
    public function surface_habitable_moyenne(): float
    {
        return $this->nombre_appartement ? $this->surface_habitable / $this->nombre_appartement : $this->surface_habitable;
    }
}
