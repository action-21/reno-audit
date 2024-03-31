<?php

namespace App\Domain\PlancherBas\Table;

use App\Domain\Common\Table\TableValueCollection;
use App\Domain\Common\Table\InterpolationDouble;

/**
 * @property Ue[] $values
 */
final class UeCollection extends TableValueCollection
{
    use InterpolationDouble;

    public function ue(float $upb, float $surface, float $perimetre): float
    {
        $x = $upb;
        $y = $perimetre ? \round(2 * $surface / $perimetre) : 0;

        return $this->p($x, $y);
    }

    /**
     * @param float $x = Upb
     * @param float $y = 2S/P
     * @return float[]
     */
    public function sequence(float $x, float $y): array
    {
        /** @var float[] */
        $sequence = [];

        $xs = $this->xs($x);
        $ys = $this->filter(fn (Ue $item): bool => \in_array($item->x(), $xs))->ys($y);

        $sequence['x1'] = $xs[0] ?? null;
        $sequence['x2'] = $xs[1] ?? null;
        $sequence['y1'] = $ys[0] ?? null;
        $sequence['y2'] = $ys[1] ?? null;
        $sequence['q11'] = $this->q($sequence['x1'], $sequence['y1']);
        $sequence['q12'] = $this->q($sequence['x1'], $sequence['y2']);
        $sequence['q21'] = $this->q($sequence['x2'], $sequence['y1']);
        $sequence['q22'] = $this->q($sequence['x2'], $sequence['y2']);

        return $sequence;
    }

    /**
     * @param float $x = upb
     * @return float[]
     */
    public function xs(float $x): array
    {
        return $this
            ->usort(fn (Ue $a, Ue $b): int => \round(\abs($a->x() - $x) - \abs($b->x() - $x)))
            ->slice(0, 2)
            ->map(fn (Ue $item): float => $item->x());
    }

    /**
     * @param float $y = 2S/P
     * @return float[]
     */
    public function ys(float $y): array
    {
        return $this
            ->usort(fn (Ue $a, Ue $b): int => \round(\abs($a->y() - $y) - \abs($b->y() - $y)))
            ->slice(0, 2)
            ->map(fn (Ue $item): float => $item->y());
    }

    /**
     * @param ?float $x = Upb
     * @param ?float $y = 2S/P
     * @return ?float = Ue
     */
    public function q(?float $x, ?float $y): ?float
    {
        foreach ($this->values as $value) {
            if ($value->x() === $x && $value->y() == $y) {
                return $value->ue();
            }
        }
        return null;
    }
}
