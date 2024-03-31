<?php

namespace App\Domain\MasqueProche;

use App\Domain\Batiment\Batiment;
use App\Domain\MasqueProche\Enum\{Orientation, TypeMasqueProche};

final class MasqueProche
{
    private TypeMasqueProche $type_masque;

    public function __construct(
        private readonly \Stringable $reference,
        private readonly Batiment $batiment,
        private string $description,
        private ?float $avancee,
        private ?Orientation $orientation,
    ) {
    }

    public function update(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Baie en fond de balcon ou fond et flanc de loggias
     * 
     * @param float $avancee - Avancée de l'obstacle en m
     * @param Orientation $orientation - Orientation du masque proche
     */
    public function set_fond_balcon_ou_fond_flanc_loggias(float $avancee, Orientation $orientation): self
    {
        $this->avancee = $avancee;
        $this->orientation = $orientation;
        $this->type_masque = TypeMasqueProche::FOND_BALCON_OU_FOND_ET_FLANC_LOGGIAS;

        return $this;
    }

    /**
     * Baie sous un balcon ou auvent
     * 
     * @param float $avancee - Avancée de l'obstacle en m
     */
    public function set_balcon_ou_auvent(float $avancee): self
    {
        $this->avancee = $avancee;
        $this->orientation = null;
        $this->type_masque = TypeMasqueProche::BALCON_OU_AUVENT;

        return $this;
    }

    /**
     * Baie masquée par une paroi latérale
     * 
     * @param bool $obstacle_au_sud - Indique si le masque fait obstacle au sud
     */
    public function set_paroi_laterale(bool $obstacle_au_sud): self
    {
        $this->avancee = null;
        $this->orientation = null;
        $this->type_masque = $obstacle_au_sud
            ? TypeMasqueProche::PAROI_LATERALE_AVEC_OBSTACLE_AU_SUD
            : TypeMasqueProche::PAROI_LATERALE_SANS_OBSTACLE_AU_SUD;

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

    public function avancee(): ?float
    {
        return $this->avancee;
    }

    public function orientation(): ?Orientation
    {
        return $this->orientation;
    }

    public function type_masque(): TypeMasqueProche
    {
        return $this->type_masque;
    }
}
