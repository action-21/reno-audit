<?php

namespace App\Domain\Common\Identifier;

final class Uuid implements \Stringable
{
    public function __construct(public readonly string $value)
    {
    }

    public static function create(): self
    {
        throw new \DomainException("Implémentation en cours");
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
