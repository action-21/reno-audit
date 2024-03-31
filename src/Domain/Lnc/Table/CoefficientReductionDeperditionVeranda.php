<?php

namespace App\Domain\Lnc\Table;

use App\Domain\Common\Enum\Enum;
use App\Domain\Common\Table\TableValue;

/**
 * @property Enum[] $orientations
 */
class CoefficientReductionDeperditionVeranda implements TableValue
{
    public function __construct(
        public readonly int $id,
        public readonly array $orientations,
        public readonly float $bver
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    /** @return int[] */
    public function orientations(): array
    {
        return $this->orientations;
    }

    public function bver(): float
    {
        return $this->bver;
    }
}
