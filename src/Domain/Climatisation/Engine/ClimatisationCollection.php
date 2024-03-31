<?php

namespace App\Domain\Moteur3CL\Refroidissement;

use App\Domain\Moteur3CL\Common\Mois;

final class ClimatisationCollection
{
    /**
     * @var Climatisation[]
     */
    private array $collection;

    public function __construct(private Climatisation $climatisation)
    {
    }

    /**
     * ∑cfr - Somme des consommations de refroidissement (kWh)
     */
    public function cfr(bool $scenario_depensier = false, bool $energie_primaire = false): float
    {
        return \array_reduce($this->collection, fn (Climatisation $item, float $cfr): float => $cfr += $item->cfr($scenario_depensier, $energie_primaire), 0);
    }

    /**
     * ∑cfr,j - Somme des consommations de refroidissement pour le mois j (kWh)
     */
    public function cfr_j(Mois $mois, bool $scenario_depensier = false): float
    {
        return \array_reduce($this->collection, fn (Climatisation $item, float $cfr): float => $cfr += $item->cfr_j($mois, $scenario_depensier), 0);
    }

    /**
     * @param ClimatisationInput[]
     */
    public function __invoke(array $input_collection): self
    {
        $this->collection = \array_map(
            fn (ClimatisationInput $input): Climatisation => ($this->climatisation)($input),
            $input_collection
        );

        return $this;
    }
}
