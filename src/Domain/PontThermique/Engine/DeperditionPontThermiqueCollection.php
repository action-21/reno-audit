<?php

namespace App\Domain\PontThermique\Engine;

use App\Domain\PontThermique\{PontThermique, PontThermiqueEngine};

final class DeperditionPontThermiqueCollection
{
    /**
     * @var DeperditionPontThermique[]
     */
    private array $collection;

    private function __construct(private DeperditionPontThermique $deperdition_pont_thermique)
    {
    }

    /**
     * ∑pt,pont_thermique - Somme des ponts thermiques
     */
    public function pt(): float
    {
        return \array_reduce($this->collection, fn (DeperditionPontThermique $item, float $pt): float => $pt += $item->pt(), 0);
    }

    /**
     * ∑l,pont_thermique - Somme des longieurs des ponts thermiques
     */
    public function l(): float
    {
        return \array_reduce($this->collection, fn (DeperditionPontThermique $item, float $l): float => $l += $item->l(), 0);
    }

    /**
     * ∑k,pont_thermique - Somme des ponts thermiques
     */
    public function k(): float
    {
        return \array_reduce($this->collection, fn (DeperditionPontThermique $item, float $k): float => $k += $item->k() * ($item->l() / $this->l() ?? 1), 0);
    }

    /**
     * @return DeperditionPontThermique[]
     */
    public function liste(): array
    {
        return $this->collection;
    }

    public function __invoke(PontThermiqueEngine $engine): self
    {
        $this->collection = \array_map(
            fn (PontThermique $input): DeperditionPontThermique => ($this->deperdition_pont_thermique)($input),
            $engine->input()->to_array(),
        );

        return $this;
    }
}
