<?php

namespace App\Domain\Common\Identifier;

final class Reference implements \Stringable
{
    public function __construct(public readonly string $value)
    {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
