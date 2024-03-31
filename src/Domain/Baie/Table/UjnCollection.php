<?php

namespace App\Domain\Baie\Table;

use App\Domain\Common\Table\InterpolationSimple;
use App\Domain\Common\Table\TableValueCollection;

/**
 * @property Ujn[] $values
 */
class UjnCollection extends TableValueCollection
{
    use InterpolationSimple;

    public function ujn(float $uw): ?float
    {
        return $this->p(x: $uw);
    }

    public function find(float $uw): ?Ujn
    {
        foreach ($this->values as $value) {
            if ($value->uw() === $uw) {
                return $value;
            }
        }
        return null;
    }

    /**
     * @inheritdoc
     */
    public function sequence(float $x): array
    {
        $xs = $this
            ->usort(fn (Ujn $a, Ujn $b): int => \round(\abs($a->x() - $x) - \abs($b->x() - $x)))
            ->slice(0, 2);

        return [
            'x' => $x,
            'x1' => \reset($xs->values)?->x(),
            'x2' => \end($xs->values)?->x(),
            'y1' => \reset($xs->values)?->y(),
            'y2' => \end($xs->values)?->y(),
        ];
    }
}
