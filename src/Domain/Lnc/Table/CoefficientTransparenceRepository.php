<?php

namespace App\Domain\Lnc\Table;

use App\Domain\Baie\Enum\{MateriauxMenuiserie, TypeVitrage};

interface CoefficientTransparenceRepository
{
    public function find(
        MateriauxMenuiserie $meteriaux_menuiserie,
        ?TypeVitrage $type_vitrage,
        ?bool $vitrage_vir,
    ): ?CoefficientTransparence;
}
