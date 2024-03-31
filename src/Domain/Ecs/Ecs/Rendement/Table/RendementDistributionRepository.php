<?php

namespace App\Domain\Moteur3CL\Ecs\Rendement\Table;

use App\Domain\Common\Enum\Ecs\{BouclageReseau, TypeInstallation};

interface RendementDistributionRepository
{
    public function find(
        TypeInstallation $type_installation,
        ?BouclageReseau $bouclage_reseau,
        ?bool $position_volume_habitable,
        ?bool $alimentation_contigue,
    ): ?RendementDistribution;
}
