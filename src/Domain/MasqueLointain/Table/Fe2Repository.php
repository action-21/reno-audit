<?php

namespace App\Domain\MasqueLointain\Table;

use App\Domain\MasqueLointain\Enum\Orientation;

interface Fe2Repository
{
    public function find(Orientation $orientation, float $hauteur_alpha): ?Fe2;
}
