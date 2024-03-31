<?php

namespace App\Domain\Batiment\Entity;

use App\Domain\Common\Collection\ArrayCollection;
use App\Domain\Logement\Enum\ClasseInertie;

/**
 * @property Niveau[] $elements
 */
final class NiveauCollection extends ArrayCollection
{
    /**
     * Retourne la première occurence correspondant à la référence en paramètre
     */
    public function find(\Stringable $reference): ?Niveau
    {
        return parent::findFirst(fn (Niveau $item): bool => $item->reference() == $reference);
    }

    /**
     * Somme des surfaces habitables en m²
     */
    public function surface_habitable(): float
    {
        return $this->reduce(fn (Niveau $item, float $sum): float => $sum += $item->surface_habitable(), 0);
    }

    /**
     * Hauteur sous plafond moyenne en m
     */
    public function hsp(): float
    {
        return ($surface_habitable = $this->surface_habitable())
            ? $this->reduce(fn (Niveau $item, float $sum): float => $sum += $item->hsp() * ($item->surface_habitable() / $surface_habitable), 0)
            : 0;
    }

    /** @return ClasseInertie[] */
    public function classe_inertie_collection(): array
    {
        /** @var ClasseInertie[] */
        $collection = [];
        // Critère de surface habitable utilisée pour filtrer les classes d'inertie représentatives
        $criteria = 0;

        foreach (ClasseInertie::cases() as $classe_inertie) {
            $surface = $this
                ->filter(fn (Niveau $item): bool => $item->classe_inertie() === $classe_inertie)
                ->reduce(fn (Niveau $item, float $surface): float => $surface += $item->surface_habitable());

            if ($surface >= $criteria) {
                $collection[] = $classe_inertie;
            }
        }
        return \array_unique($collection);
    }
}
