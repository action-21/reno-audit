<?php

namespace App\Domain\PlancherBas\Engine;

use App\Domain\Paroi\Enum\QualiteComposant;
use App\Domain\PlancherBas\{PlancherBas, PlancherBasEngine};

final class DeperditionPlancherBasCollection
{
    /**
     * @var DeperditionPlancherBas[]
     */
    private array $collection;

    private function __construct(private DeperditionPlancherBas $deperdition_plancher_bas)
    {
    }

    /**
     * ∑dp,pb - Somme des déperditions (m²)
     */
    public function dp(): float
    {
        return \array_reduce($this->collection, fn (DeperditionPlancherBas $item, float $dp): float => $dp += $item->dp(), 0);
    }

    /**
     * ∑sdep,pb - Somme des surface déperditives (m²)
     */
    public function sdep(): float
    {
        return \array_reduce($this->collection, fn (DeperditionPlancherBas $item, float $sdep): float => $sdep += $item->sdep(), 0);
    }

    /**
     * μ∑u,pb - Coefficient de transmission thermique moyen (W/(m².K))
     */
    public function u(): float
    {
        return ($sdep = $this->sdep())
            ? \array_reduce($this->collection, fn (DeperditionPlancherBas $item, float $u): float => $u += $item->ufinal() * ($item->sdep() / $sdep), 0)
            : 0;
    }

    /**
     * Indicateur de performance moyen des planchers bas
     */
    public function qualite_composant(): ?QualiteComposant
    {
        return ($u = $this->u()) ? QualiteComposant::from_upb($u) : null;
    }

    /**
     * @return DeperditionPlancherBas[]
     */
    public function to_array(): array
    {
        return $this->collection;
    }

    public function __invoke(PlancherBasEngine $engine): self
    {
        $this->collection = \array_map(
            fn (PlancherBas $item): DeperditionPlancherBas => ($this->deperdition_plancher_bas)($item, $engine),
            $engine->input()->to_array(),
        );

        return $this;
    }
}
