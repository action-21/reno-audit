<?php

namespace App\Domain\Baie\Table;

use App\Domain\Baie\Enum\{MateriauxMenuiserie, TypeBaie, TypePose, TypeVitrage};

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
