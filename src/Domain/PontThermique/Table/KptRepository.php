<?php

namespace App\Domain\PontThermique\Table;

use App\Domain\Common\Enum\Enum;
use App\Domain\Paroi\Enum\TypeIsolation;
use App\Domain\PontThermique\Enum\TypeLiaison;

interface KptRepository
{
    public function find(
        TypeLiaison $type_liaison,
        ?TypeIsolation $type_isolation_mur,
        ?TypeIsolation $type_isolation_plancher,
        ?Enum $type_pose_ouverture,
        ?bool $presence_retour_isolation,
        ?int $largeur_dormant,
    ): ?Kpt;
}
