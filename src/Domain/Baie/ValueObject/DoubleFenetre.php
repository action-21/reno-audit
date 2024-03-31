<?php

namespace App\Domain\Baie\ValueObject;

use App\Domain\Baie\Enum\{MateriauxMenuiserie, TypeBaie};
use App\Domain\Paroi\Enum\TypePose;

/**
 * TODO: Insérer une méthode de saisie de la valeur Uw
 */
final class DoubleFenetre
{
    public function __construct(
        public readonly ?float $uw_saisi,
        public readonly ?float $sw_saisi,
        public readonly TypeBaie $type_baie,
        public readonly TypePose $type_pose,
        public readonly MateriauxMenuiserie $type_materiaux_menuiserie,
        public readonly Vitrage $vitrage,
    ) {
    }
}
