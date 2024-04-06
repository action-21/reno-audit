<?php

namespace App\Domain\Porte;

use App\Domain\Enveloppe\Enveloppe;
use App\Domain\Paroi\Ouverture;
use App\Domain\Paroi\Enum\TypeParoi;
use App\Domain\Porte\Enum\TypePose;
use App\Domain\Porte\ValueObject\{Caracteristique, Performance};

/**
 * Porte donnant sur l'extérieur ou sur un local non chauffé
 */
final class Porte extends Ouverture
{
    public function __construct(
        protected readonly \Stringable $reference,
        protected readonly Enveloppe $enveloppe,
        private string $description,
        private Caracteristique $caracteristique,
        private Performance $performance,
    ) {
    }

    /**
     * Met à jour les informations d'une porte
     */
    public function update(string $description, Performance $performance, Caracteristique $caracteristique,): self
    {
        $this->description = $description;
        $this->performance = $performance;
        $this->caracteristique = $caracteristique;
        return $this;
    }

    public function type_paroi(): TypeParoi
    {
        return TypeParoi::PORTE;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function est_isole(): bool
    {
        return $this->caracteristique->type_porte->est_isole();
    }

    public function surface_deperditive(): float
    {
        return $this->caracteristique->surface;
    }

    public function largeur_dormant(): ?float
    {
        return $this->caracteristique->largeur_dormant;
    }

    public function presence_joint(): bool
    {
        return $this->caracteristique->presence_joint;
    }

    public function presence_retour_isolation(): ?bool
    {
        return $this->caracteristique->presence_retour_isolation;
    }

    public function type_pose(): TypePose
    {
        return $this->caracteristique->type_pose;
    }

    public function performance(): Performance
    {
        return $this->performance;
    }

    public function caracteristique(): Caracteristique
    {
        return $this->caracteristique;
    }
}
