<?php

namespace App\Domain\Batiment\Entity;

use App\Domain\Batiment\Batiment;
use App\Domain\Common\Identifier\Uuid;

final class Niveau
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Batiment $batiment,
        private float $surface_habitable,
        private float $hsp,
    ) {
    }

    public static function create(Batiment $batiment, float $surface_habitable, float $hsp): Niveau
    {
        return new self(
            reference: Uuid::create(),
            batiment: $batiment,
            surface_habitable: $surface_habitable,
            hsp: $hsp,
        );
    }

    public function update(float $surface_habitable, float $hsp): self
    {
        $this->surface_habitable = $surface_habitable;
        $this->hsp = $hsp;

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

    public function surface_habitable(): float
    {
        return $this->surface_habitable;
    }

    public function hsp(): float
    {
        return $this->hsp;
    }

    /*
    public function classe_inertie(): ?ClasseInertie
    {
        if ($this->classe_inertie) {
            return $this->classe_inertie;
        }
        $fn = fn (ParoiOpaque $item): bool => $item->reference_niveau() === $this->reference();

        return ClasseInertie::fromInertieParois(
            plancher_bas_lourd: $this->logement->plancher_bas_collection()->filter($fn)->paroi_lourde(),
            plancher_haut_lourd: $this->logement->plancher_bas_collection()->filter($fn)->paroi_lourde(),
            paroi_verticale_lourd: $this->paroi_verticale_lourde !== null
                ? $this->paroi_verticale_lourde
                : $this->logement->mur_collection()->filter($fn)->paroi_lourde(),
        );
    }*/
}
