<?php

namespace App\Domain\Mur\Table;

use App\Domain\Mur\Enum\MateriauxStructure;

interface Umur0Repository
{
    public function find(MateriauxStructure $materiaux_structure, ?float $epaisseur_structure): ?Umur0;
    public function search(MateriauxStructure $materiaux_structure): Umur0Collection;
}
