<?php

namespace App\Domain\Baie\ValueObject;

use App\Domain\Baie\Enum\{MateriauxMenuiserie, MethodeSaisieUw};

final class Menuiserie
{
    public function __construct(
        public readonly bool $presence_joint,
        public readonly bool $presence_retour_isolation,
        public readonly float $largeur_dormant,
        public readonly ?float $uw_saisi,
        public readonly MateriauxMenuiserie $type_materiaux,
        public readonly MethodeSaisieUw $methode_saisie_uw,
    ) {
    }
}
