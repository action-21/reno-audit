<?php

namespace App\Domain\Logement\Entity;

use App\Domain\Common\Identifier\Uuid;
use App\Domain\Logement\Logement;

final class Niveau
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Logement $logement,
        private string $description,
        private float $surface_habitable,
        private float $hsp,
    ) {
    }

    public static function create(
        Logement $logement,
        string $description,
        float $surface_habitable,
        float $hsp,
    ): self {
        return new self(
            reference: Uuid::create(),
            logement: $logement,
            description: $description,
            surface_habitable: $surface_habitable,
            hsp: $hsp,
        );
    }

    public function update(
        string $description,
        float $surface_habitable,
        float $hsp,
    ): self {
        $this->description = $description;
        $this->surface_habitable = $surface_habitable;
        $this->hsp = $hsp;

        return $this;
    }

    public function reference(): \Stringable
    {
        return $this->reference;
    }

    public function logement(): Logement
    {
        return $this->logement;
    }

    public function description(): string
    {
        return $this->description;
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
    }
    */
}
