<?php

namespace App\Domain\Mur;

use App\Domain\Enveloppe\Enveloppe;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\Mur\ValueObject\{Caracteristique};
use App\Domain\Paroi\Enum\{Mitoyennete, Orientation, PeriodeIsolation, TypeIsolation, TypeParoi};
use App\Domain\Paroi\ParoiOpaque;
use App\Domain\Paroi\ValueObject\{Performance, PerformanceIsolation};

/**
 * Mur donnant sur l'extérieur ou sur un local non chauffé
 */
final class Mur extends ParoiOpaque
{
    public function __construct(
        protected readonly ?\Stringable $reference,
        protected readonly Enveloppe $enveloppe,
        private string $description,
        private Orientation $orientation,
        private Caracteristique $caracteristique,
        private Performance $performance,
        private PerformanceIsolation $performance_isolation,
    ) {
    }

    /**
     * Crée un mur
     */
    public static function create(
        Enveloppe $enveloppe,
        string $description,
        Orientation $orientation,
        Caracteristique $caracteristique,
        Performance $performance,
        PerformanceIsolation $performance_isolation,
    ): self {
        return new self(
            reference: Uuid::create(),
            enveloppe: $enveloppe,
            description: $description,
            orientation: $orientation,
            caracteristique: $caracteristique,
            performance: $performance,
            performance_isolation: $performance_isolation,
        );
    }

    /**
     * Met à jour un mur
     */
    public function update(
        string $description,
        Orientation $orientation,
        Caracteristique $caracteristique,
        Performance $performance,
        PerformanceIsolation $performance_isolation,
    ): self {
        $this->description = $description;
        $this->orientation = $orientation;
        $this->caracteristique = $caracteristique;
        $this->performance = $performance;
        $this->performance_isolation = $performance_isolation;
        return $this;
    }

    /**
     * Met à jour la mitoyenneté du mur
     */
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
        return TypeParoi::MUR;
    }

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
            ? $this->enveloppe()->batiment()->audit()->periode_construction()->type_isolation_mur_defaut()
            : $this->type_isolation();
    }

    /**
     * @inheritdoc
     */
    public function periode_isolation(): ?PeriodeIsolation
    {
        return $this->performance_isolation->periode_isolation;
    }

    public function periode_construction_isolation(): ?PeriodeIsolation
    {
        if ($this->periode_isolation()) {
            return $this->periode_isolation();
        }
        return $this->type_isolation()->est_isole()
            ? $this->enveloppe()->batiment()->audit()->periode_construction()->periode_isolation_mur_defaut()
            : $this->enveloppe()->batiment()->audit()->periode_construction();
    }

    /**
     * @inheritdoc
     */
    public function facade(): bool
    {
        return $this->mitoyennete->exterieur();
    }
}
