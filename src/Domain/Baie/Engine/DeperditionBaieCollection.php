<?php

namespace App\Domain\Baie\Engine;

use App\Domain\Baie\{Baie, BaieCollection};
use App\Domain\Paroi\Enum\QualiteComposant;

final class DeperditionBaieCollection
{
    /**
     * @var DeperditionBaie[]
     */
    private array $collection;

    private function __construct(private DeperditionBaie $deperdition_baie)
    {
    }

    /**
     * ∑dp,baie - Somme des déperditions (m²)
     */
    public function dp(): float
    {
        return \array_reduce($this->collection, fn (DeperditionBaie $item, float $dp): float => $dp += $item->dp(), 0);
    }

    /**
     * ∑sdep,baie - Somme des surface déperditives (m²)
     */
    public function sdep(): float
    {
        return \array_reduce($this->collection, fn (DeperditionBaie $item, float $sdep): float => $sdep += $item->sdep(), 0);
    }

    /**
     * μ∑u,baie - Coefficient de transmission thermique moyen (W/(m².K))
     */
    public function u(): float
    {
        return ($sdep = $this->sdep())
            ? \array_reduce($this->collection, fn (DeperditionBaie $item, float $u): float => $u += $item->u() * ($item->sdep() / $sdep), 0)
            : 0;
    }

    /**
     * Indicateur de performance moyen des planchers hauts
     */
    public function qualite_composant(): ?QualiteComposant
    {
        return ($u = $this->u()) ? QualiteComposant::from_ubaie($u) : null;
    }

    /**
     * @return DeperditionBaie[]
     */
    public function to_array(): array
    {
        return $this->collection;
    }

    public function __invoke(BaieCollection $input): self
    {
        $this->collection = \array_map(
            fn (Baie $item): DeperditionBaie => ($this->deperdition_baie)($item),
            $input->to_array(),
        );

        return $this;
    }
}
