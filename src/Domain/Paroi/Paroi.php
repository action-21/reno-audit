<?php

namespace App\Domain\Paroi;

use App\Domain\Batiment\Batiment;
use App\Domain\Lnc\Lnc;
use App\Domain\Paroi\Enum\{Mitoyennete, TypeAdjacence, TypeParoi};

abstract class Paroi
{
    protected readonly \Stringable $reference;
    protected readonly Batiment $batiment;

    /**
     * Identifiant unique de la paroi
     */
    public function reference(): \Stringable
    {
        return $this->reference;
    }

    /**
     * Bâtiment rattaché à la paroi
     */
    public function batiment(): Batiment
    {
        return $this->batiment;
    }

    /**
     * Type d'adjacence
     */
    public function type_adjacence(): TypeAdjacence
    {
        return TypeAdjacence::create_from(mitoyennete: $this->mitoyennete(), type_lnc: $this->local_non_chauffe()?->type_lnc());
    }

    /**
     * Local non chauffé associé à la paroi
     */
    abstract public function local_non_chauffe(): ?Lnc;

    /**
     * Type de paroi
     */
    abstract public function type_paroi(): TypeParoi;

    /**
     * Surface déperditive de la paroi en m²
     */
    abstract public function surface_deperditive(): float;

    /**
     * État d'isolation de la paroi
     */
    abstract public function est_isole(): bool;

    /**
     * Mitoyenneté de la paroi
     */
    abstract public function mitoyennete(): Mitoyennete;
}
