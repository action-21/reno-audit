<?php

namespace App\Domain\PontThermique;

use App\Domain\Baie\Baie;
use App\Domain\Batiment\Batiment;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\Mur\Mur;
use App\Domain\Paroi\Ouverture;
use App\Domain\PlancherBas\PlancherBas;
use App\Domain\PlancherHaut\PlancherHaut;
use App\Domain\PlancherIntermediaire\PlancherIntermediaire;
use App\Domain\PontThermique\Enum\TypeLiaison;
use App\Domain\PontThermique\ValueObject\{Caracteristique, Performance};
use App\Domain\Porte\Porte;
use App\Domain\Refend\Refend;

final class PontThermique
{
    private TypeLiaison $type_liaison;

    public function __construct(
        private readonly \Stringable $reference,
        private readonly Batiment $batiment,
        private ?Mur $mur,
        private null|PlancherHaut|PlancherBas|PlancherIntermediaire $plancher,
        private ?Refend $refend,
        private ?Ouverture $ouverture,
        private string $description,
        private Caracteristique $caracteristique,
        private Performance $performance,
    ) {
    }

    /**
     * TODO: à supprimer
     * 
     * Méthode temporaire pour la récupération des données depuis l'opendata
     */
    public static function create(
        Batiment $batiment,
        string $description,
        TypeLiaison $type_liaison,
        Caracteristique $caracteristique,
        Performance $performance,
    ): self {
        $entity = new self(
            reference: Uuid::create(),
            batiment: $batiment,
            description: $description,
            caracteristique: $caracteristique,
            performance: $performance,
            mur: null,
            plancher: null,
            refend: null,
            ouverture: null,
        );

        $entity->type_liaison = $type_liaison;

        return $entity;
    }

    public function update(
        string $description,
        Caracteristique $caracteristique,
        Performance $performance,
    ): self {
        $this->description = $description;
        $this->caracteristique = $caracteristique;
        $this->performance = $performance;

        return $this;
    }

    public function set_liaison_plancher_bas_mur(\Stringable $reference_plancher, \Stringable $reference_mur,): self
    {
        if (null === $mur = $this->batiment->mur_collection()->find($reference_mur)) {
            throw new \InvalidArgumentException("Mur $reference_mur not found");
        }
        if (null === $plancher = $this->batiment->plancher_haut_collection()->find($reference_plancher)) {
            if (null === $plancher = $this->batiment->plancher_bas_collection()->find($reference_plancher)) {
                throw new \InvalidArgumentException("Plancher $reference_plancher not found");
            }
        }
        $this->mur = $mur;
        $this->plancher = $plancher;
        $this->type_liaison = TypeLiaison::PLANCHER_BAS_MUR;
        return $this;
    }

    public function set_liaison_plancher_intermediaire_mur(\Stringable $reference_plancher, \Stringable $reference_mur,): self
    {
        if (null === $mur = $this->batiment->mur_collection()->find($reference_mur)) {
            throw new \InvalidArgumentException("Mur $reference_mur not found");
        }
        if (null === $plancher = $this->batiment->plancher_intermediaire_collection()->find($reference_plancher)) {
            throw new \InvalidArgumentException("Plancher intermédiaire $reference_plancher not found");
        }
        $this->mur = $mur;
        $this->plancher = $plancher;
        $this->type_liaison = TypeLiaison::PLANCHER_INTERMEDIAIRE_MUR;
        return $this;
    }

    public function set_liaison_plancher_haut_mur(\Stringable $reference_mur, \Stringable $reference_plancher,): self
    {
        if (null === $mur = $this->batiment->mur_collection()->find($reference_mur)) {
            throw new \InvalidArgumentException("Mur $reference_mur not found");
        }
        if (null === $plancher = $this->batiment->plancher_haut_collection()->find($reference_plancher)) {
            throw new \InvalidArgumentException("Plancher intermédiaire $reference_plancher not found");
        }
        $this->mur = $mur;
        $this->plancher = $plancher;
        $this->type_liaison = TypeLiaison::PLANCHER_HAUT_MUR;
        return $this;
    }

    public function set_liaison_refend_mur(\Stringable $reference_refend, \Stringable $reference_mur,): self
    {
        if (null === $mur = $this->batiment->mur_collection()->find($reference_mur)) {
            throw new \InvalidArgumentException("Mur $reference_mur not found");
        }
        if (null === $refend = $this->batiment->refend_collection()->find($reference_refend)) {
            throw new \InvalidArgumentException("Refend $reference_refend not found");
        }
        $this->mur = $mur;
        $this->refend = $refend;
        $this->type_liaison = TypeLiaison::REFEND_MUR;
        return $this;
    }

    public function set_liaison_menuiserie_mur(
        \Stringable $reference_ouverture,
        \Stringable $reference_mur,
    ): self {
        if (null === $mur = $this->batiment->mur_collection()->find($reference_mur)) {
            throw new \InvalidArgumentException("Mur $reference_mur not found");
        }
        if (null === $ouverture = $this->batiment->paroi_collection()->search_ouverture()->find($reference_ouverture)) {
            throw new \InvalidArgumentException("Ouverture $reference_ouverture not found");
        }
        $this->mur = $mur;
        $this->ouverture = $ouverture;
        $this->type_liaison = TypeLiaison::MENUISERIE_MUR;
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

    public function mur(): ?Mur
    {
        return $this->mur;
    }

    public function plancher(): null|PlancherBas|PlancherHaut|PlancherIntermediaire
    {
        return $this->plancher;
    }

    public function ouverture(): null|Baie|Porte
    {
        return $this->ouverture;
    }

    public function refend(): ?Refend
    {
        return $this->refend;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function type_liaison(): TypeLiaison
    {
        return $this->type_liaison;
    }

    public function caracteristique(): Caracteristique
    {
        return $this->caracteristique;
    }

    public function performance(): Performance
    {
        return $this->performance;
    }
}
