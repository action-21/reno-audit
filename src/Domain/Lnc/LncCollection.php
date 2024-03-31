<?php

namespace App\Domain\Lnc;

use App\Domain\Common\Collection\ArrayCollection;
use App\Domain\Lnc\Enum\TypeLnc;

/**
 * @property Lnc[] $elements
 */
final class LncCollection extends ArrayCollection
{
    /**
     * Retourne la première occurence correspondant à la référence
     */
    public function find(\Stringable $reference): ?Lnc
    {
        return $this->findFirst(fn (Lnc $item): bool => $item->reference() === $reference);
    }

    /**
     * Retourne une collection d'espaces tampons solarisés
     */
    public function search_by_type_lnc(TypeLnc $type_lnc): self
    {
        return $this->filter(fn (Lnc $item): bool => $item->type_lnc() === $type_lnc);
    }
}
