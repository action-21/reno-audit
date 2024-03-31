<?php

namespace App\Domain\Batiment\Table;

use App\Domain\Common\Enum\Mois;
use App\Domain\Common\Table\TableValue;

/**
 * @see §16.1
 */
final class Nhecl implements TableValue
{
    public function __construct(
        public readonly int $id,
        public readonly Mois $mois,
        public readonly float $nhecl,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    /**
     * Nh,j - Nombre d’heures de fonctionnement de l’éclairage sur le mois j (h)
     */
    public function nh_j(): float
    {
        return $this->mois->nj() * $this->nhecl;
    }
}
