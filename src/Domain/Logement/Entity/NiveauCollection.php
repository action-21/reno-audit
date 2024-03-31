<?php

namespace App\Domain\Logement\Entity;

use App\Domain\Common\Collection\ArrayCollection;

/**
 * @property Niveau[] $elements
 */
final class NiveauCollection extends ArrayCollection
{
    /**
     * Surface habitable totale des niveaux
     */
    public function surface_habitable(): float
    {
        return $this->reduce(fn (Niveau $item, float $sum): float => $sum += $item->surface_habitable(), 0);
    }

    /**
     * Hauteur sous plafond moyenne des niveaux
     */
    public function hsp(): float
    {
        return ($surface_habitable = $this->surface_habitable())
            ? $this->reduce(fn (Niveau $item, float $sum): float => $sum += $item->hsp() * ($item->surface_habitable() / $surface_habitable), 0)
            : 0;
    }
}
