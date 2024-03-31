<?php

namespace App\Domain\MasqueProche;

use App\Domain\Common\Collection\ArrayCollection;

/**
 * @property MasqueProche[] $elements
 */
final class MasqueProcheCollection extends ArrayCollection
{
    /**
     * Retourne la première occurence correspondant à la référence
     */
    public function find(\Stringable $reference): ?MasqueProche
    {
        return $this->findFirst(fn (MasqueProche $element) => $element->reference() == $reference);
    }
}
