<?php

namespace App\Domain\Refend;

use App\Domain\Batiment\Batiment;
use App\Domain\Common\Identifier\Uuid;

final class Refend
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Batiment $batiment,
        private string $description,
        private float $epaisseur,
    ) {
    }

    public static function create(
        Batiment $batiment,
        string $description,
        float $epaisseur,
    ): self {
        return new self(
            reference: Uuid::create(),
            batiment: $batiment,
            description: $description,
            epaisseur: $epaisseur,
        );
    }

    public function update(string $description, float $epaisseur): self
    {
        $this->description = $description;
        $this->epaisseur = $epaisseur;

        return $this;
    }

    public function reference(): \Stringable
    {
        return $this->reference;
    }

    public function batiment(): Batiment
    {
        return $this->batiment;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function epaisseur(): float
    {
        return $this->epaisseur;
    }
}
