<?php

namespace App\Domain\Baie;

use App\Domain\Baie\Enum\TypePose;
use App\Domain\Baie\ValueObject\{Caracteristique, DoubleFenetre, Fermeture, Menuiserie, Performance, Vitrage};
use App\Domain\Enveloppe\Enveloppe;
use App\Domain\Lnc\Lnc;
use App\Domain\MasqueLointain\MasqueLointainCollection;
use App\Domain\MasqueProche\MasqueProcheCollection;
use App\Domain\Paroi\{Ouverture, ParoiOpaque};
use App\Domain\Paroi\Enum\{Orientation, TypeAdjacence, TypeParoi};
use App\Domain\PlancherHaut\PlancherHaut;

/**
 * Baie vitrée donnant sur l'extérieur ou sur un local non chauffé
 */
final class Baie extends Ouverture
{
    public function __construct(
        protected readonly \Stringable $reference,
        protected readonly Enveloppe $enveloppe,
        private string $description,
        private TypeAdjacence $type_adjacence,
        private Orientation $orientation,
        private Caracteristique $caracteristique,
        private Performance $performance,
        private Vitrage $vitrage,
        private Menuiserie $menuiserie,
        private ?Fermeture $fermeture,
        private ?DoubleFenetre $double_fenetre,
        private MasqueProcheCollection $masque_proche_collection,
    ) {
    }

    public function update(
        string $description,
        Orientation $orientation,
        TypeAdjacence $type_adjacence,
        Caracteristique $caracteristique,
        Performance $performance,
        Vitrage $vitrage,
        Menuiserie $menuiserie,
        ?Fermeture $fermeture,
        ?DoubleFenetre $double_fenetre,
    ): self {
        $this->description = $description;
        $this->orientation = $orientation;
        $this->type_adjacence = $type_adjacence;
        $this->caracteristique = $caracteristique;
        $this->performance = $performance;
        $this->vitrage = $vitrage;
        $this->menuiserie = $menuiserie;
        $this->fermeture = $fermeture;
        $this->double_fenetre = $double_fenetre;

        return $this;
    }

    public function type_paroi(): TypeParoi
    {
        return TypeParoi::BAIE;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function est_isole(): bool
    {
        return $this->vitrage->type_vitrage?->est_isole() ?? false;
    }

    public function surface_deperditive(): float
    {
        return $this->caracteristique->surface;
    }

    public function orientation(): Orientation
    {
        return $this->orientation;
    }

    public function fenetre_toit(): ?bool
    {
        return $this->paroi_opaque() instanceof PlancherHaut;
    }

    public function presence_joint(): bool
    {
        return $this->caracteristique->presence_joint;
    }

    public function largeur_dormant(): ?float
    {
        return $this->caracteristique->largeur_dormant;
    }

    public function presence_retour_isolation(): ?bool
    {
        return $this->caracteristique->presence_retour_isolation;
    }

    public function type_pose(): TypePose
    {
        return $this->caracteristique->type_pose;
    }

    public function caracteristique(): Caracteristique
    {
        return $this->caracteristique;
    }

    public function performance(): Performance
    {
        return $this->performance;
    }

    public function vitrage(): Vitrage
    {
        return $this->vitrage;
    }

    public function menuiserie(): Menuiserie
    {
        return $this->menuiserie;
    }

    public function fermeture(): ?Fermeture
    {
        return $this->fermeture;
    }

    public function double_fenetre(): ?DoubleFenetre
    {
        return $this->double_fenetre;
    }

    public function masque_proche_collection(): MasqueProcheCollection
    {
        return $this->masque_proche_collection;
    }

    public function masque_lointain_collection(): MasqueLointainCollection
    {
        return $this->enveloppe->masque_lointain_collection()->search_by_orientation(
            orientation: $this->orientation()->id()
        );
    }
}
