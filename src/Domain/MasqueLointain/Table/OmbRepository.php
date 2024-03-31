<?php

namespace App\Domain\MasqueLointain\Table;

use App\Domain\MasqueLointain\Enum\{Orientation, SecteurMasque};

interface OmbRepository
{
    public function find(SecteurMasque $secteur, Orientation $orientation, float $hauteur_alpha): ?Omb;
}
