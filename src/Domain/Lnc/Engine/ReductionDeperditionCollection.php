<?php

namespace App\Domain\Lnc\Engine;

use App\Domain\Lnc\{Lnc, LncCollection};

final class ReductionDeperditionCollection
{
    /**
     * @var ReductionDeperdition[]
     */
    private array $collection = [];

    public function __construct(private ReductionDeperdition $reduction_deperdition)
    {
    }

    /**
     * Coefficient de réduction des déperditions thermiques des parois donnant sur un local non chauffé
     */
    public function b(Lnc $lnc): ?float
    {
        return $this->find($lnc)?->b();
    }

    /**
     * Retourne la réduction des déperditions correspondant au LNC
     */
    public function find(Lnc $lnc): ?ReductionDeperdition
    {
        foreach ($this->collection as $item) {
            if ($item->input()->reference() == $lnc->reference()) {
                return $item;
            }
        }
        return null;
    }

    /**
     * @return SurfaceSudEquivalente[]
     */
    public function to_array(): array
    {
        return $this->collection;
    }

    public function __invoke(LncCollection $input): self
    {
        $this->collection = \array_map(
            fn (Lnc $item): ReductionDeperdition => ($this->reduction_deperdition)($item),
            $input->to_array(),
        );

        return $this;
    }
}
