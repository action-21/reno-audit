<?php

namespace App\Domain\Common\Table;

/**
 * @property TableValue[] $values
 */
abstract class TableValueCollection
{
    public function __construct(public readonly array $values = [])
    {
    }

    public function count(): int
    {
        return \count($this->values);
    }

    /**
     * Tri par ordre croissant
     */
    public function sort(): static
    {
        $values = [...$this->values];

        usort($values, fn (TableValue $a, TableValue $b): int => $b->id() - $a->id());

        return new static($values);
    }

    /**
     * Tri par ordre décroissant
     */
    public function asort(): static
    {
        $values = [...$this->values];

        usort($values, fn (TableValue $a, TableValue $b): int => $a->id() - $b->id());

        return new static($values);
    }

    public function usort(\Closure $p): static
    {
        $values = [...$this->values];

        usort($values, $p);

        return new static($values);
    }

    public function slice(int $offset, ?int $length,): static
    {
        return new static(\array_slice($this->values, $offset, $length));
    }

    public function filter(\Closure $p): static
    {
        return new static(array_filter($this->values, $p, ARRAY_FILTER_USE_BOTH));
    }

    public function map(\Closure $func): array
    {
        return array_map($func, $this->values);
    }

    public function reduce(\Closure $func, $initial = null): mixed
    {
        return array_reduce($this->values, $func, $initial);
    }

    public function findFirst(\Closure $p): mixed
    {
        foreach ($this->values as $key => $element) {
            if ($p($key, $element)) {
                return $element;
            }
        }
        return null;
    }

    /** @return int[] */
    public function toIds(): array
    {
        return \array_map(fn (TableValue $item): int => $item->id(), $this->values);
    }
}
