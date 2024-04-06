<?php

namespace App\Domain\Paroi;

use App\Domain\Lnc\Lnc;
use App\Domain\Paroi\Enum\{Mitoyennete, Orientation, TypeIsolation};
use App\Domain\Paroi\ValueObject\{Performance, PerformanceIsolation};

abstract class ParoiOpaque extends Paroi
{
    protected ?Lnc $local_non_chauffe = null;
    protected Mitoyennete $mitoyennete;
    protected Performance $performance;
    protected PerformanceIsolation $performance_isolation;

    /**
     * @inheritdoc
     */
    public function local_non_chauffe(): ?Lnc
    {
        return $this->local_non_chauffe;
    }

    public function performance(): Performance
    {
        return $this->performance;
    }

    public function performance_isolation(): PerformanceIsolation
    {
        return $this->performance_isolation;
    }

    /**
     * @inheritdoc
     */
    public function mitoyennete(): Mitoyennete
    {
        return $this->mitoyennete;
    }

    protected function fetch_local_non_chauffe(\Stringable $reference_local_non_chauffe): ?Lnc
    {
        if (null === $entity = $this->enveloppe->lnc_collection()->find($reference_local_non_chauffe)) {
            throw new \DomainException('Local non chauffé non trouvé');
        }
        if (false === $entity->type_lnc()->applicable($this->type_paroi())) {
            throw new \DomainException('Type de local non chauffé non applicable');
        }
        return $entity;
    }

    /**
     * @inheritdoc
     */
    public function surface_deperditive(): float
    {
        return $this->surface_pleine();
    }

    /**
     * Surface de la paroi corrigée de la surface des ouvertures en m²
     */
    public function surface_pleine(): float
    {
        return $this->surface() - $this->enveloppe->paroi_collection()->search_ouverture()->search_by_paroi_opaque($this)->surface_deperditive();
    }

    /**
     * Surface totale de la paroi en m²
     */
    abstract public function surface(): float;

    /**
     * Paroi verticale en contact avec l'extérieur
     */
    abstract public function facade(): bool;

    /**
     * Type d'isolation de la paroi
     */
    abstract public function type_isolation(): TypeIsolation;

    /**
     * Orientation de la paroi
     */
    abstract public function orientation(): Orientation;
}
