<?php

namespace App\Domain\MasqueLointain\Table;

use App\Domain\MasqueLointain\Enum\{Orientation, SecteurOrientation};

interface OmbRepository
{
    public function find(SecteurOrientation $secteur_orientation, Orientation $orientation, float $hauteur_alpha): ?Omb;
}
