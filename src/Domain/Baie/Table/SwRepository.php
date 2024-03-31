<?php

namespace App\Domain\Baie\Table;

use App\Domain\Baie\Enum\{MateriauxMenuiserie, TypeBaie, TypeVitrage};
use App\Domain\Paroi\Enum\TypePose;

interface SwRepository
{
    public function find(
        TypeBaie $type_baie,
        MateriauxMenuiserie $materiaux_menuiserie,
        ?TypePose $type_pose,
        ?TypeVitrage $type_vitrage,
        ?bool $vitrage_vir
    ): ?Sw;
}
