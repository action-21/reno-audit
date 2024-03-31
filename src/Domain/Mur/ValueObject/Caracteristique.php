<?php

namespace App\Domain\Mur\ValueObject;

use App\Domain\Mur\Enum\{MateriauxStructure, TypeDoublage};

final class Caracteristique
{
    public function __construct(
        public readonly float $surface,
        public readonly ?float $epaisseur_structure,
        public readonly bool $enduit_isolant_paroi_ancienne,
        public readonly bool $paroi_ancienne,
        public readonly bool $paroi_lourde,
        public readonly MateriauxStructure $materiaux_structure,
        public readonly TypeDoublage $type_doublage,
    ) {
    }
}
