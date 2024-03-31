<?php

namespace App\Domain\Paroi;

/**
 * @property Ouverture[] $elements
 */
class OuvertureCollection extends ParoiCollection
{
    /**
     * Retourne une collection par paroi associée
     */
    public function search_by_paroi_opaque(ParoiOpaque $paroi_opaque): self
    {
        return $this->filter(fn (Ouverture $item): bool => $item->paroi_opaque()?->reference() == $paroi_opaque->reference());
    }

    /**
     * Présence majoritaire de joint d'étanchéité
     */
    public function presence_joint(): bool
    {
        return $this->filter(fn (Ouverture $item): bool => $item->presence_joint())->surface_deperditive() > $this->surface_deperditive() / 2;
    }
}
