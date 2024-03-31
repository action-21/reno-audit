<?php

namespace App\Domain\Common\Enum;

/**
 * @property Enum[] $values
 */
class EnumCollection
{
    public function __construct(public readonly array $values)
    {
    }

    public function count(): int
    {
        return \count($this->values);
    }

    public function has(int $id): bool
    {
        return $this->filter(fn (Enum $item): bool => $item->id() === $id)->count() > 0;
    }

    public function filter(\Closure $p): static
    {
        return new static(array_filter($this->values, $p, ARRAY_FILTER_USE_BOTH));
    }

    public function unique(): self
    {
        $exists = [];

        return $this->filter(function (Enum $item) use (&$exists) {
            if (\in_array($item->id(), $exists)) {
                return false;
            }
            $exists[] = $item->id();
            return true;
        });
    }

    public function values(): array
    {
        return $this->values;
    }
}
