<?php

namespace App\Domain\PlancherIntermediaire;

use App\Domain\Enveloppe\Enveloppe;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\PlancherIntermediaire\Enum\TypePlancherIntermediaire;

final class PlancherIntermediaire
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Enveloppe $enveloppe,
        private string $description,
        private float $surface,
        private float $epaisseur,
        private TypePlancherIntermediaire $type_plancher,
    ) {
    }

    /**
     * Créé un nouveau plancher intermédiaire
     */
    public static function create(
        Enveloppe $enveloppe,
        string $description,
        float $surface,
        float $epaisseur,
        TypePlancherIntermediaire $type_plancher,
    ): self {
        return new self(
            reference: Uuid::create(),
            enveloppe: $enveloppe,
            description: $description,
            surface: $surface,
            epaisseur: $epaisseur,
            type_plancher: $type_plancher,
        );
    }

    /**
     * Met à jour les informations du plancher intermédiaire
     */
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

    public function enveloppe(): Enveloppe
    {
        return $this->enveloppe;
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
