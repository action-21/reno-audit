<?php

namespace App\Domain\MasqueLointain;

use App\Domain\Enveloppe\Enveloppe;
use App\Domain\MasqueLointain\Enum\{Orientation, SecteurOrientation, TypeMasqueLointain};

/**
 * Obstacle d'environnement lointain
 */
final class MasqueLointain
{
    private TypeMasqueLointain $type_masque;

    public function __construct(
        private readonly \Stringable $reference,
        private readonly Enveloppe $enveloppe,
        private string $description,
        private float $hauteur_alpha,
        private Orientation $orientation,
        private ?SecteurOrientation $secteur_orientation,
    ) {
    }

    /**
     * Met à jour un masque lointain
     */
    public function update(string $description, float $hauteur_alpha, Orientation $orientation): self
    {
        $this->description = $description;
        $this->hauteur_alpha = $hauteur_alpha;
        $this->orientation = $orientation;
        return $this;
    }

    /**
     * Met à jour un masque lointain homogène
     */
    public function set_masque_lointain_homogene(): self
    {
        $this->secteur_orientation = null;
        $this->type_masque = TypeMasqueLointain::MASQUE_LOINTAIN_HOMOGENE;
        return $this;
    }

    /**
     * Met à jour un masque lointain non homogène
     */
    public function set_masque_lointain_non_homogene(SecteurOrientation $secteur_orientation): self
    {
        $this->secteur_orientation = $secteur_orientation;
        $this->type_masque = TypeMasqueLointain::MASQUE_LOINTAIN_NON_HOMOGENE;
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

    public function hauteur_alpha(): float
    {
        return $this->hauteur_alpha;
    }

    public function orientation(): Orientation
    {
        return $this->orientation;
    }

    public function type_masque(): TypeMasqueLointain
    {
        return $this->type_masque;
    }

    public function secteur_orientation(): ?SecteurOrientation
    {
        return $this->secteur_orientation;
    }
}
