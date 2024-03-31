<?php

namespace App\Domain\Baie;

use App\Domain\Baie\ValueObject\{Caracteristique, DoubleFenetre, Fermeture, Menuiserie, Performance, Vitrage};
use App\Domain\Batiment\Batiment;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\Lnc\Lnc;
use App\Domain\MasqueLointain\MasqueLointainCollection;
use App\Domain\MasqueProche\MasqueProcheCollection;
use App\Domain\Paroi\{Ouverture, ParoiOpaque};
use App\Domain\Paroi\Enum\{Orientation, TypeAdjacence, TypeParoi, TypePose};
use App\Domain\PlancherHaut\PlancherHaut;

final class Baie implements Ouverture
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Batiment $batiment,
        private ?ParoiOpaque $paroi_opaque,
        private ?Lnc $lnc,
        private string $description,
        private TypeAdjacence $type_adjacence,
        private Orientation $orientation,
        private Caracteristique $caracteristique,
        private Performance $performance,
        private Vitrage $vitrage,
        private Menuiserie $menuiserie,
        private Fermeture $fermeture,
        private ?DoubleFenetre $double_fenetre,
        private MasqueProcheCollection $masque_proche_collection,
    ) {
    }

    public static function create(
        Batiment $batiment,
        string $description,
        Orientation $orientation,
        TypeAdjacence $type_adjacence,
        Caracteristique $caracteristique,
        Performance $performance,
        Vitrage $vitrage,
        Menuiserie $menuiserie,
        Fermeture $fermeture,
        ?DoubleFenetre $double_fenetre,
    ): self {
        return new self(
            reference: Uuid::create(),
            batiment: $batiment,
            description: $description,
            orientation: $orientation,
            type_adjacence: $type_adjacence,
            caracteristique: $caracteristique,
            performance: $performance,
            vitrage: $vitrage,
            menuiserie: $menuiserie,
            fermeture: $fermeture,
            double_fenetre: $double_fenetre,
            paroi_opaque: null,
            lnc: null,
            masque_proche_collection: new MasqueProcheCollection(),
        );
    }

    public function update(
        string $description,
        Orientation $orientation,
        TypeAdjacence $type_adjacence,
        Caracteristique $caracteristique,
        Performance $performance,
        Vitrage $vitrage,
        Menuiserie $menuiserie,
        Fermeture $fermeture,
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

    public function bind_lnc(\Stringable $reference_lnc): self
    {
        if ($reference_lnc == $this->lnc()?->reference()) {
            return $this;
        }
        if (null === $entity = $this->batiment->lnc_collection()->find($reference_lnc)) {
            throw new \DomainException(sprintf('Lnc %s not found', $reference_lnc));
        }
        $this->lnc = $entity;
        return $this;
    }

    public function detach_lnc(): self
    {
        $this->lnc = null;
        return $this;
    }

    public function bind_paroi_opaque(\Stringable $reference_paroi_opaque): self
    {
        if ($reference_paroi_opaque == $this->paroi_opaque()?->reference()) {
            return $this;
        }
        if (null === $entity = $this->batiment->paroi_collection()->paroi_opaque_collection()->find($reference_paroi_opaque)) {
            throw new \DomainException(sprintf('Paroi opaque %s not found', $reference_paroi_opaque));
        }
        $this->paroi_opaque = $entity;
        $this->orientation = $entity->orientation();
        $this->type_adjacence = $entity->type_adjacence();

        return $this;
    }

    public function detach_paroi_opaque(): self
    {
        $this->paroi_opaque = null;
        return $this;
    }

    public function reference(): \Stringable
    {
        return $this->reference;
    }

    public function batiment(): Batiment
    {
        return $this->batiment;
    }

    public function paroi_opaque(): ?ParoiOpaque
    {
        return $this->paroi_opaque;
    }

    public function type_paroi(): TypeParoi
    {
        return TypeParoi::ID_04;
    }

    public function lnc(): ?Lnc
    {
        return $this->lnc();
    }

    public function adjacence_ets(): bool
    {
        return $this->lnc()?->ets();
    }

    public function description(): string
    {
        return $this->description;
    }

    public function type_adjacence(): TypeAdjacence
    {
        return $this->type_adjacence;
    }

    public function surface(): float
    {
        return $this->caracteristique->surface;
    }

    public function surface_deperditive(): float
    {
        return $this->surface();
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
        return $this->menuiserie->presence_joint;
    }

    public function largeur_dormant(): ?float
    {
        return $this->menuiserie->largeur_dormant;
    }

    public function presence_retour_isolation(): ?bool
    {
        return $this->menuiserie->presence_retour_isolation;
    }

    public function isolation(): bool
    {
        return $this->vitrage->type_vitrage->isolation();
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

    public function fermeture(): Fermeture
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
        return $this->batiment->masque_lointain_collection()->searchByOrientation(
            orientation: $this->orientation()->id()
        );
    }
}
