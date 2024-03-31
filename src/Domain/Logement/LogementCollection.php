<?php

namespace App\Domain\Logement;

use App\Domain\Common\Collection\ArrayCollection;

/**
 * @property Logement[] $elements
 */
final class LogementCollection extends ArrayCollection
{
    public function first(): ?Logement
    {
        return parent::first();
    }

    public function filterByNiveau(int $niveau): self
    {
        return $this->filter(fn (Logement $item): bool => $item->niveau() === $niveau);
    }

    /**
     * Surface habitable totale (m²)
     */
    public function surface_habitable(): float
    {
        return $this->reduce(fn (Logement $item, float $surface): float => $surface += $item->surface_habitable(), 0);
    }

    /**
     * Surface habitable moyenne (m²)
     */
    public function surface_habitable_moyenne(): float
    {
        return $this->count() > 0 ? $this->surface_habitable() / $this->count() : 0;
    }

    /**
     * Hauteur sous plafond moyenne (m)
     */
    public function hsp_moyenne(): float
    {
        return ($count = $this->count() > 0)
            ? $this->reduce(fn (Logement $item, float $hsp): float => $hsp += $item->hsp() / $count, 0)
            : 0;
    }

    /*
    public function batiment_materiaux_anciens(): bool
    {
        return ($this
            ->filter(fn (Logement $item): bool => $item->batiment_materiaux_anciens())
            ->surface_habitable()) < ($this->surface_habitable() / 2);
    }

    public function parois_anciennes_lourdes(): bool
    {
        return ($this
            ->filter(fn (Logement $item): bool => $item->parois_anciennes_lourdes())
            ->surface_habitable()) < ($this->surface_habitable() / 2);
    }*/
}
