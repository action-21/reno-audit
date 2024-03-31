<?php

namespace App\Domain\Common\Collection;

class ArrayCollection implements Collection
{
    public function __construct(protected array $elements = [])
    {
    }

    protected function createFrom(array $elements): static
    {
        return new static($elements);
    }

    public function count(): int
    {
        return \count($this->elements);
    }

    public function to_array(): array
    {
        return $this->elements;
    }

    public function first(): mixed
    {
        return reset($this->elements);
    }

    public function has(\Closure $p): bool
    {
        return $this->findFirst($p) !== null;
    }

    public function filter(\Closure $p): static
    {
        return $this->createFrom(array_filter($this->elements, $p, ARRAY_FILTER_USE_BOTH));
    }

    public function map(\Closure $func): static
    {
        return $this->createFrom(array_map($func, $this->elements));
    }

    public function reduce(\Closure $func, $initial = null): mixed
    {
        return array_reduce($this->elements, $func, $initial);
    }

    public function findFirst(\Closure $p): mixed
    {
        foreach ($this->elements as $key => $element) {
            if ($p($key, $element)) {
                return $element;
            }
        }
        return null;
    }

    public function add(mixed $element)
    {
        $this->elements[] = $element;
    }

    public function values(): array
    {
        return $this->elements;
    }
}
