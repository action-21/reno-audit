<?php

namespace App\Domain\Lnc\Entity;

use App\Domain\Common\Identifier\Uuid;
use App\Domain\Lnc\Lnc;

/**
 * Paroi du local non chauffé donnant sur l'extérieur ou en contact avec le sol (paroi enterrée, terre-plein)
 */
final class Paroi
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Lnc $local_non_chauffe,
        private string $description,
        private float $surface,
        private bool $isolation,
    ) {
    }

    public static function create(Lnc $local_non_chauffe, string $description, float $surface, bool $isolation): self
    {
        return new self(
            reference: Uuid::create(),
            local_non_chauffe: $local_non_chauffe,
            description: $description,
            surface: $surface,
            isolation: $isolation,
        );
    }

    public function update(string $description, float $surface, bool $isolation): self
    {
        $this->description = $description;
        $this->surface = $surface;
        $this->isolation = $isolation;

        return $this;
    }

    public function reference(): \Stringable
    {
        return $this->reference;
    }

    public function local_non_chauffe(): Lnc
    {
        return $this->local_non_chauffe;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function surface(): float
    {
        return $this->surface;
    }

    public function isolation(): bool
    {
        return $this->isolation;
    }
}
