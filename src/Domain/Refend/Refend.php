<?php

namespace App\Domain\Refend;

use App\Domain\Enveloppe\Enveloppe;
use App\Domain\Common\Identifier\Uuid;

final class Refend
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Enveloppe $enveloppe,
        private string $description,
        private float $epaisseur,
        private float $hauteur,
        private float $longueur,
    ) {
    }

    /**
     * Crée un nouveau refend
     */
    public static function create(
        Enveloppe $enveloppe,
        string $description,
        float $epaisseur,
        float $hauteur,
        float $longueur,
    ): self {
        return new self(
            reference: Uuid::create(),
            enveloppe: $enveloppe,
            description: $description,
            epaisseur: $epaisseur,
            hauteur: $hauteur,
            longueur: $longueur,
        );
    }

    /**
     * Met à jour les informations du refend
     */
    public function update(string $description, float $epaisseur, float $hauteur, float $longueur): self
    {
        $this->description = $description;
        $this->epaisseur = $epaisseur;
        $this->hauteur = $hauteur;
        $this->longueur = $longueur;

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

    public function epaisseur(): float
    {
        return $this->epaisseur;
    }

    public function hauteur(): float
    {
        return $this->hauteur;
    }

    public function longueur(): float
    {
        return $this->longueur;
    }
}
