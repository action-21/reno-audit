<?php

namespace App\Domain\Mur\Table;

use App\Domain\Common\Table\TableValue;

class Umur0 implements TableValue
{
    public function __construct(
        public readonly int $id,
        public readonly ?float $epaisseur_structure,
        public readonly float $umur0
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function epaisseur_structure(): ?float
    {
        return $this->epaisseur_structure;
    }

    public function umur0(): float
    {
        return $this->umur0;
    }

    public function x(): ?float
    {
        return $this->epaisseur_structure;
    }

    public function y(): float
    {
        return $this->umur0;
    }
}
