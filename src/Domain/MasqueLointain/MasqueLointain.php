<?php

namespace App\Domain\MasqueLointain;

use App\Domain\Batiment\Batiment;
use App\Domain\MasqueLointain\Enum\{Orientation, SecteurMasque, TypeMasqueLointain};

final class MasqueLointain
{
    private TypeMasqueLointain $type_masque;

    public function __construct(
        private readonly \Stringable $reference,
        private readonly Batiment $batiment,
        private string $description,
        private float $hauteur_alpha,
        private Orientation $orientation,
        private ?SecteurMasque $secteur,
    ) {
    }

    public function update(string $description, float $hauteur_alpha, Orientation $orientation): self
    {
        $this->description = $description;
        $this->hauteur_alpha = $hauteur_alpha;
        $this->orientation = $orientation;
        return $this;
    }

    public function set_masque_lointain_homogene(): self
    {
        $this->type_masque = TypeMasqueLointain::MASQUE_LOINTAIN_HOMOGENE;
        return $this;
    }

    public function set_masque_lointain_non_homogene(SecteurMasque $secteur): self
    {
        $this->secteur = $secteur;
        $this->type_masque = TypeMasqueLointain::MASQUE_LOINTAIN_NON_HOMOGENE;
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

    public function secteur(): ?SecteurMasque
    {
        return $this->secteur;
    }
}
