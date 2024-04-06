<?php

namespace App\Domain\Mur\Engine;

use App\Domain\Mur\{Mur, MurCollection, MurEngine};
use App\Domain\Paroi\Enum\QualiteComposant;

final class DeperditionMurCollection
{
    /**
     * @var DeperditionMur[]
     */
    private array $collection;

    private function __construct(private DeperditionMur $deperdition_mur)
    {
    }

    /**
     * ∑dp,mur - Somme des déperditions (m²)
     */
    public function dp(): float
    {
        return \array_reduce($this->collection, fn (DeperditionMur $item, float $dp): float => $dp += $item->dp(), 0);
    }

    /**
     * ∑sdep,mur - Somme des surface déperditives (m²)
     */
    public function sdep(): float
    {
        return \array_reduce($this->collection, fn (DeperditionMur $item, float $sdep): float => $sdep += $item->sdep(), 0);
    }

    /**
     * μ∑u,mur - Coefficient de transmission thermique moyen (W/(m².K))
     */
    public function u(): float
    {
        return ($sdep = $this->sdep())
            ? \array_reduce($this->collection, fn (DeperditionMur $item, float $u): float => $u += $item->u() * ($item->sdep() / $sdep), 0)
            : 0;
    }

    /**
     * Indicateur de performance moyen des planchers hauts
     */
    public function qualite_composant(): ?QualiteComposant
    {
        return ($u = $this->u()) ? QualiteComposant::from_umur($u) : null;
    }

    /**
     * @return DeperditionMur[]
     */
    public function to_array(): array
    {
        return $this->collection;
    }

    public function __invoke(MurEngine $engine): self
    {
        $this->collection = \array_map(
            fn (Mur $item): DeperditionMur => ($this->deperdition_mur)($item, $engine),
            $engine->input()->to_array(),
        );

        return $this;
    }
}
