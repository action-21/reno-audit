<?php

namespace App\Domain\Porte\Engine;

use App\Domain\Paroi\Enum\QualiteComposant;
use App\Domain\Porte\{Porte, PorteEngine};

final class DeperditionPorteCollection
{
    /**
     * @var DeperditionPorte[]
     */
    private array $collection;

    private function __construct(private DeperditionPorte $deperdition_porte)
    {
    }

    /**
     * ∑dp,ph - Somme des déperditions (m²)
     */
    public function dp(): float
    {
        return \array_reduce($this->collection, fn (DeperditionPorte $item, float $dp): float => $dp += $item->dp(), 0);
    }

    /**
     * ∑sdep,ph - Somme des surface déperditives (m²)
     */
    public function sdep(): float
    {
        return \array_reduce($this->collection, fn (DeperditionPorte $item, float $sdep): float => $sdep += $item->sdep(), 0);
    }

    /**
     * μ∑u,ph - Coefficient de transmission thermique moyen (W/(m².K))
     */
    public function u(): float
    {
        return ($sdep = $this->sdep())
            ? \array_reduce($this->collection, fn (DeperditionPorte $item, float $u): float => $u += $item->u() * ($item->sdep() / $sdep), 0)
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
     * @return DeperditionPorte[]
     */
    public function liste(): array
    {
        return $this->collection;
    }

    public function __invoke(PorteEngine $engine): self
    {
        $this->collection = \array_map(
            fn (Porte $item): DeperditionPorte => ($this->deperdition_porte)($item, $engine),
            $engine->input()->to_array(),
        );

        return $this;
    }
}
