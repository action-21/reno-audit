<?php

namespace App\Command\Simulation\Apport\SurfaceSudEquivalente;

use App\Domain\Audit\Masque\MasqueLointain;
use App\Domain\Common\Enum\Masque\{Orientation, SecteurMasque, TypeMasqueLointain};

final class SseMasqueLointainCommand
{
    public function __construct(
        public readonly float $hauteur_alpha,
        public readonly TypeMasqueLointain $type_masque,
        public readonly Orientation $orientation,
        public readonly ?SecteurMasque $secteur,
    ) {
    }

    public static function from(MasqueLointain $entity,): self
    {
        return new self(
            hauteur_alpha: $entity->hauteur_alpha(),
            type_masque: $entity->type_masque(),
            orientation: $entity->orientation(),
            secteur: $entity->secteur(),
        );
    }
}
