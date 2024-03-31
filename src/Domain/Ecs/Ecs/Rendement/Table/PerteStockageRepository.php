<?php

namespace App\Domain\Moteur3CL\Ecs\Rendement\Table;

use App\Domain\Common\Enum\Ecs\TypeGenerateur;

interface PerteStockageRepository
{
    public function find(TypeGenerateur $type_generateur, float $volume_stockage): ?PerteStockage;
}