<?php

namespace App\Domain\Mur\Table;

use App\Domain\Common\Table\{InterpolationSimple, TableValueCollection};

/**
 * @property Umur0[] $values
 */
class Umur0Collection extends TableValueCollection
{
    use InterpolationSimple;

    public function umur0(float $epaisseur_structure): ?float
    {
        $x = $epaisseur_structure;
        return $this->p($x);
    }

    /**
     * @inheritdoc
     */
    public function sequence(float $x): array
    {
        $xs = $this
            ->usort(fn (Umur0 $a, Umur0 $b): int => \round(\abs($a->x() - $x) - \abs($b->x() - $x)))
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
