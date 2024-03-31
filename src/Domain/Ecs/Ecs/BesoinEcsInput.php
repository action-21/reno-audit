<?php

namespace App\Domain\Moteur3CL\Ecs;

use App\Domain\Batiment\Enum\TypeBatiment;

interface BesoinEcsInput
{
    /**
     * Nombre de logements
     */
    public function logements(): int;

    /**
     * Surface habitable moyenne
     */
    public function surface_habitable_moyenne(): float;

    /**
     * Type de bâtiment
     */
    public function type_batiment(): TypeBatiment;
}
