<?php

namespace App\Domain\PlancherHaut;

use App\Domain\Batiment\Batiment;
use App\Domain\Batiment\Enum\PeriodeConstruction;
use App\Domain\Lnc\Lnc;
use App\Domain\Paroi\ParoiOpaque;
use App\Domain\Paroi\Enum\{Mitoyennete, Orientation, PeriodeIsolation, TypeIsolation, TypeParoi};
use App\Domain\Paroi\ValueObject\{Performance, PerformanceIsolation};
use App\Domain\PlancherHaut\Enum\{ConfigurationPlancherHaut};
use App\Domain\PlancherHaut\ValueObject\Caracteristique;

final class PlancherHaut extends ParoiOpaque
{
    private ConfigurationPlancherHaut $configuration_plancher_haut;

    public function __construct(
        protected readonly \Stringable $reference,
        protected readonly Batiment $batiment,
        protected Performance $performance,
        protected PerformanceIsolation $performance_isolation,
        private string $description,
        private Caracteristique $caracteristique,
        private Orientation $orientation,
    ) {
    }

    public function update(
        string $description,
        Caracteristique $caracteristique,
        Performance $performance,
        PerformanceIsolation $performance_isolation,
        Orientation $orientation,
    ): self {
        $this->description = $description;
        $this->caracteristique = $caracteristique;
        $this->performance = $performance;
        $this->performance_isolation = $performance_isolation;
        $this->orientation = $orientation;

        return $this;
    }

    public function set_combles_perdus(\Stringable $reference_local_non_chauffe): self
    {
        $this->configuration_plancher_haut = ConfigurationPlancherHaut::COMBLES_PERDUS;
        $this->local_non_chauffe = $this->fetch_local_non_chauffe($reference_local_non_chauffe);
        $this->mitoyennete = Mitoyennete::LOCAL_NON_CHAUFFE;
        return $this;
    }

    public function set_combles_habitables(Mitoyennete $mitoyennete, ?\Stringable $reference_local_non_chauffe): self
    {
        if ($reference_local_non_chauffe) {
            $this->configuration_plancher_haut = ConfigurationPlancherHaut::COMBLES_HABITABLES;
            $this->local_non_chauffe = $this->fetch_local_non_chauffe($reference_local_non_chauffe);
            $this->mitoyennete = Mitoyennete::LOCAL_NON_CHAUFFE;
            return $this;
        }
        $this->configuration_plancher_haut = ConfigurationPlancherHaut::COMBLES_HABITABLES;
        $this->set_mitoyennete($mitoyennete);
        return $this;
    }

    public function set_toiture_terrasse(Mitoyennete $mitoyennete, ?\Stringable $reference_local_non_chauffe): self
    {
        if ($reference_local_non_chauffe) {
            $this->configuration_plancher_haut = ConfigurationPlancherHaut::TOITURE_TERRASSE;
            $this->local_non_chauffe = $this->fetch_local_non_chauffe($reference_local_non_chauffe);
            $this->mitoyennete = Mitoyennete::LOCAL_NON_CHAUFFE;
            return $this;
        }
        $this->configuration_plancher_haut = ConfigurationPlancherHaut::TOITURE_TERRASSE;
        $this->set_mitoyennete($mitoyennete);
        return $this;
    }

    protected function fetch_local_non_chauffe(\Stringable $reference_local_non_chauffe): ?Lnc
    {
        $entity = parent::fetch_local_non_chauffe($reference_local_non_chauffe);

        if (false === $this->configuration_plancher_haut->local_non_chauffe_applicable($entity->type_lnc())) {
            throw new \DomainException('Type de local non chauffé incompatible');
        }
        return $entity;
    }

    private function set_mitoyennete(Mitoyennete $mitoyennete, ?\Stringable $reference_local_non_chauffe = null): self
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

    public function type_paroi(): TypeParoi
    {
        return TypeParoi::PLANCHER_HAUT;
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
    public function surface(): float
    {
        return $this->caracteristique->surface;
    }

    /**
     * @inheritdoc
     */
    public function orientation(): Orientation
    {
        return $this->orientation;
    }

    /**
     * @inheritdoc
     */
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
            ? $this->batiment()->audit()->periode_construction()->type_isolation_plancher_haut_defaut()
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
            ? $this->batiment()->caracteristique()->periode_construction->periode_isolation_plancher_haut_defaut()
            : $this->batiment()->caracteristique()->periode_construction;
    }

    public function configuration_plancher_haut(): ConfigurationPlancherHaut
    {
        return $this->configuration_plancher_haut;
    }

    /**
     * @inheritdoc
     */
    public function facade(): bool
    {
        return $this->caracteristique->type_plancher_haut->facade() && $this->mitoyennete->exterieur();
    }
}
