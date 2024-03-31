<?php

namespace App\Domain\Paroi;

use App\Domain\Lnc\Lnc;
use App\Domain\Common\Collection\ArrayCollection;
use App\Domain\Paroi\Enum\TypeParoi;

/**
 * @property Paroi[] $elements
 */
class ParoiCollection extends ArrayCollection
{
    /**
     * Retourne la première occurence correspondant à la référence en paramètre
     */
    public function find(\Stringable $reference): ?Paroi
    {
        return $this->findFirst(fn (Paroi $item): bool => $item->reference() == $reference);
    }

    /**
     * Retourne la première occurence correspondant au Local Non Chauffé en paramètre
     */
    public function find_by_local_non_chauffe(Lnc $lnc): ?Paroi
    {
        return $this->findFirst(fn (Paroi $item): bool => $item->local_non_chauffe()?->reference() == $lnc->reference());
    }

    /**
     * Retourne une collection de parois correspondant au Local Non Chauffé en paramètre
     */
    public function search_by_local_non_chauffe(Lnc $lnc): self
    {
        return $this->filter(fn (Paroi $item): bool => $item->local_non_chauffe()?->reference() == $lnc->reference());
    }

    /**
     * Retourne une collection filtrée par type de paroi
     */
    public function search_without_type(TypeParoi $type_paroi): self
    {
        return $this->filter(fn (Paroi $item): bool => $item->type_paroi() != $type_paroi);
    }

    /**
     * Retourne une collection de paroi opaque
     */
    public function search_paroi_opaque(): ParoiOpaqueCollection
    {
        return new ParoiOpaqueCollection(
            $this->filter(fn (Paroi $item): bool => $item->type_paroi()->paroi_opaque())->to_array()
        );
    }

    /**
     * Retourne une collection d'ouverture
     */
    public function search_ouverture(): OuvertureCollection
    {
        return new OuvertureCollection(
            $this->filter(fn (Paroi $item): bool => $item->type_paroi()->ouverture())->to_array()
        );
    }

    /**
     * Somme des surfaces déperties des parois de la collection en m²
     */
    public function surface_deperditive(): float
    {
        return $this->reduce(fn (Paroi $item, float $sdep): float => $sdep += $item->surface_deperditive(), 0);
    }

    /**
     * État d'isolation majoritaire des parois de la collection
     */
    public function est_isole(): bool
    {
        return $this->filter(fn (Paroi $item): bool => $item->est_isole())->surface_deperditive() > $this->surface_deperditive() / 2;
    }
}
