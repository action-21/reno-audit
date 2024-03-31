<?php

namespace App\Domain\PlancherIntermediaire;

use App\Domain\Batiment\Batiment;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\PlancherIntermediaire\Enum\TypePlancherIntermediaire;

final class PlancherIntermediaire
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Batiment $batiment,
        private string $description,
        private float $surface,
        private float $epaisseur,
        private TypePlancherIntermediaire $type_plancher,
    ) {
    }

    public static function create(
        Batiment $batiment,
        string $description,
        float $surface,
        float $epaisseur,
        TypePlancherIntermediaire $type_plancher,
    ): self {
        return new self(
            reference: Uuid::create(),
            batiment: $batiment,
            description: $description,
            surface: $surface,
            epaisseur: $epaisseur,
            type_plancher: $type_plancher,
        );
    }

    public function update(
        string $description,
        float $surface,
        float $epaisseur,
        TypePlancherIntermediaire $type_plancher,
    ): self {
        $this->description = $description;
        $this->surface = $surface;
        $this->epaisseur = $epaisseur;
        $this->type_plancher = $type_plancher;
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

    public function surface(): float
    {
        return $this->surface;
    }

    public function epaisseur(): float
    {
        return $this->epaisseur;
    }

    public function type_plancher(): TypePlancherIntermediaire
    {
        return $this->type_plancher;
    }
}
