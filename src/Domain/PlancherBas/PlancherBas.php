<?php

namespace App\Domain\PlancherBas;

use App\Domain\Batiment\Batiment;
use App\Domain\Batiment\Enum\PeriodeConstruction;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\Paroi\ParoiOpaque;
use App\Domain\Paroi\Enum\{Mitoyennete, Orientation, PeriodeIsolation, TypeIsolation, TypeParoi};
use App\Domain\Paroi\ValueObject\{Performance, PerformanceIsolation};
use App\Domain\PlancherBas\ValueObject\Caracteristique;

final class PlancherBas extends ParoiOpaque
{
    public function __construct(
        protected readonly \Stringable $reference,
        protected readonly Batiment $batiment,
        private string $description,
        private Caracteristique $caracteristique,
        private Performance $performance,
        private PerformanceIsolation $performance_isolation,
    ) {
    }

    public static function create(
        Batiment $batiment,
        string $description,
        Caracteristique $caracteristique,
        Performance $performance,
        PerformanceIsolation $performance_isolation,
    ): self {
        return new self(
            reference: Uuid::create(),
            batiment: $batiment,
            description: $description,
            caracteristique: $caracteristique,
            performance: $performance,
            performance_isolation: $performance_isolation,
        );
    }

    public function update(
        ?string $description,
        Caracteristique $caracteristique,
        Performance $performance,
        PerformanceIsolation $performance_isolation,
    ): self {
        $this->description = $description;
        $this->caracteristique = $caracteristique;
        $this->performance = $performance;
        $this->performance_isolation = $performance_isolation;
        return $this;
    }

    public function set_mitoyennete(Mitoyennete $mitoyennete, ?\Stringable $reference_local_non_chauffe = null): self
    {
        if ($mitoyennete === Mitoyennete::LOCAL_NON_CHAUFFE) {
            if (null === $reference_local_non_chauffe) {
                throw new \DomainException('Local non chauffé requis');
            }
            $this->local_non_chauffe = $this->fetch_local_non_chauffe($reference_local_non_chauffe);
            $this->mitoyennete = $mitoyennete;
        } else {
            $this->mitoyennete = $mitoyennete;
            $this->local_non_chauffe = null;
        }
        return $this;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function caracteristique(): Caracteristique
    {
        return $this->caracteristique;
    }

    /**
     * @inheritdoc
     */
    public function type_paroi(): TypeParoi
    {
        return TypeParoi::PLANCHER_BAS;
    }

    /**
     * @inheritdoc
     */
    public function surface(): float
    {
        return $this->caracteristique->surface;
    }

    public function orientation(): Orientation
    {
        return Orientation::HORIZONTAL;
    }

    public function est_isole(): bool
    {
        return (bool) $this->type_isolation_defaut()->est_isole();
    }

    /**
     * @inheritdoc
     */
    public function type_isolation(): TypeIsolation
    {
        return $this->performance_isolation->type_isolation;
    }

    public function type_isolation_defaut(): TypeIsolation
    {
        return $this->type_isolation()->inconnu()
            ? $this->batiment()->audit()->periode_construction()->type_isolation_plancher_bas_defaut()
            : $this->type_isolation();
    }

    /**
     * @inheritdoc
     */
    public function periode_isolation(): ?PeriodeIsolation
    {
        return $this->performance_isolation->periode_isolation;
    }

    public function periode_construction_isolation(): PeriodeIsolation|PeriodeConstruction
    {
        if ($this->periode_isolation()) {
            return $this->periode_isolation();
        }
        return $this->type_isolation()->est_isole()
            ? $this->batiment()->audit()->periode_construction()->periode_isolation_plancher_bas_defaut()
            : $this->batiment->audit()->periode_construction();
    }

    /**
     * @inheritdoc
     */
    public function facade(): bool
    {
        return false;
    }
}
