<?php

namespace App\Domain\PlancherHaut\Engine;

use App\Domain\Batiment\BatimentEngine;
use App\Domain\Paroi\Enum\QualiteComposant;
use App\Domain\PlancherHaut\{PlancherHaut, PlancherHautCollection};

final class DeperditionPlancherHautCollection
{
    /**
     * @var DeperditionPlancherHaut[]
     */
    private array $collection;

    private function __construct(private DeperditionPlancherHaut $deperdition_plancher_haut)
    {
    }

    /**
     * ∑dp,ph - Somme des déperditions (m²)
     */
    public function dp(): float
    {
        return \array_reduce($this->collection, fn (DeperditionPlancherHaut $item, float $dp): float => $dp += $item->dp(), 0);
    }

    /**
     * ∑sdep,ph - Somme des surface déperditives (m²)
     */
    public function sdep(): float
    {
        return \array_reduce($this->collection, fn (DeperditionPlancherHaut $item, float $sdep): float => $sdep += $item->sdep(), 0);
    }

    /**
     * μ∑u,ph - Coefficient de transmission thermique moyen (W/(m².K))
     */
    public function u(): float
    {
        return ($sdep = $this->sdep())
            ? \array_reduce($this->collection, fn (DeperditionPlancherHaut $item, float $u): float => $u += $item->u() * ($item->sdep() / $sdep), 0)
            : 0;
    }

    /**
     * Indicateur de performance moyen des planchers hauts
     */
    public function qualite_composant(): ?QualiteComposant
    {
        return ($u = $this->u()) ? QualiteComposant::from_uph($u) : null;
    }

    /**
     * @return DeperditionPlancherHaut[]
     */
    public function to_array(): array
    {
        return $this->collection;
    }

    public function __invoke(PlancherHautCollection $input, BatimentEngine $context): self
    {
        $this->collection = \array_map(
            fn (PlancherHaut $item): DeperditionPlancherHaut => ($this->deperdition_plancher_haut)($item, $context),
            $input->to_array()
        );

        return $this;
    }
}
