<?php

namespace App\Domain\MasqueProche;

use App\Domain\Enveloppe\Enveloppe;
use App\Domain\MasqueProche\Enum\{Orientation, TypeMasqueProche};

/**
 * Obstacle d'environnement proche
 */
final class MasqueProche
{
    private TypeMasqueProche $type_masque_proche;

    public function __construct(
        private readonly \Stringable $reference,
        private readonly Enveloppe $enveloppe,
        private string $description,
        private ?float $avancee,
        private ?Orientation $orientation,
    ) {
    }

    /**
     * Met à jour la description du masque proche
     */
    public function update(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Met à jour un masque proche de type baie en fond de balcon ou fond et flanc de loggias
     */
    public function set_fond_balcon_ou_fond_flanc_loggias(float $avancee, Orientation $orientation): self
    {
        $this->avancee = $avancee;
        $this->orientation = $orientation;
        $this->type_masque_proche = TypeMasqueProche::FOND_BALCON_OU_FOND_ET_FLANC_LOGGIAS;

        return $this;
    }

    /**
     * Met à jour un masque proche de type baie sous un balcon ou auvent
     */
    public function set_balcon_ou_auvent(float $avancee): self
    {
        $this->avancee = $avancee;
        $this->orientation = null;
        $this->type_masque_proche = TypeMasqueProche::BALCON_OU_AUVENT;

        return $this;
    }

    /**
     * Met à jour un masque proche de type baie masquée par une paroi latérale
     */
    public function set_paroi_laterale(bool $obstacle_au_sud): self
    {
        $this->avancee = null;
        $this->orientation = null;
        $this->type_masque_proche = $obstacle_au_sud
            ? TypeMasqueProche::PAROI_LATERALE_AVEC_OBSTACLE_AU_SUD
            : TypeMasqueProche::PAROI_LATERALE_SANS_OBSTACLE_AU_SUD;

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

    public function avancee(): ?float
    {
        return $this->avancee;
    }

    public function orientation(): ?Orientation
    {
        return $this->orientation;
    }

    public function type_masque_proche(): TypeMasqueProche
    {
        return $this->type_masque_proche;
    }
}
