<?php

namespace App\Domain\PontThermique;

use App\Domain\Baie\Baie;
use App\Domain\Enveloppe\Enveloppe;
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
        private readonly Enveloppe $enveloppe,
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
     * Met à jour les informations du pont thermique
     */
    public function update(string $description, Caracteristique $caracteristique, Performance $performance): self
    {
        $this->description = $description;
        $this->caracteristique = $caracteristique;
        $this->performance = $performance;

        return $this;
    }

    /**
     * Met à jour une liaison entre un mur et un plancher bas
     */
    public function set_liaison_plancher_bas_mur(\Stringable $reference_plancher, \Stringable $reference_mur,): self
    {
        if (null === $mur = $this->enveloppe->mur_collection()->find($reference_mur)) {
            throw new \InvalidArgumentException("Mur $reference_mur not found");
        }
        if (null === $plancher = $this->enveloppe->plancher_haut_collection()->find($reference_plancher)) {
            if (null === $plancher = $this->enveloppe->plancher_bas_collection()->find($reference_plancher)) {
                throw new \InvalidArgumentException("Plancher $reference_plancher not found");
            }
        }
        $this->mur = $mur;
        $this->plancher = $plancher;
        $this->refend = null;
        $this->ouverture = null;
        $this->type_liaison = TypeLiaison::PLANCHER_BAS_MUR;
        return $this;
    }

    /**
     * Met à jour une liaison entre un mur et un plancher intermédiaire
     */
    public function set_liaison_plancher_intermediaire_mur(\Stringable $reference_plancher, \Stringable $reference_mur,): self
    {
        if (null === $mur = $this->enveloppe->mur_collection()->find($reference_mur)) {
            throw new \InvalidArgumentException("Mur $reference_mur not found");
        }
        if (null === $plancher = $this->enveloppe->plancher_intermediaire_collection()->find($reference_plancher)) {
            throw new \InvalidArgumentException("Plancher intermédiaire $reference_plancher not found");
        }
        $this->mur = $mur;
        $this->plancher = $plancher;
        $this->refend = null;
        $this->ouverture = null;
        $this->type_liaison = TypeLiaison::PLANCHER_INTERMEDIAIRE_MUR;
        return $this;
    }

    /**
     * Met à jour une liaison entre un mur et un plancher haut
     */
    public function set_liaison_plancher_haut_mur(\Stringable $reference_mur, \Stringable $reference_plancher,): self
    {
        if (null === $mur = $this->enveloppe->mur_collection()->find($reference_mur)) {
            throw new \InvalidArgumentException("Mur $reference_mur not found");
        }
        if (null === $plancher = $this->enveloppe->plancher_haut_collection()->find($reference_plancher)) {
            throw new \InvalidArgumentException("Plancher intermédiaire $reference_plancher not found");
        }
        $this->mur = $mur;
        $this->plancher = $plancher;
        $this->refend = null;
        $this->ouverture = null;
        $this->type_liaison = TypeLiaison::PLANCHER_HAUT_MUR;
        return $this;
    }

    /**
     * Met à jour une liaison entre un refend et un mur
     */
    public function set_liaison_refend_mur(\Stringable $reference_refend, \Stringable $reference_mur,): self
    {
        if (null === $mur = $this->enveloppe->mur_collection()->find($reference_mur)) {
            throw new \InvalidArgumentException("Mur $reference_mur not found");
        }
        if (null === $refend = $this->enveloppe->refend_collection()->find($reference_refend)) {
            throw new \InvalidArgumentException("Refend $reference_refend not found");
        }
        $this->mur = $mur;
        $this->refend = $refend;
        $this->plancher = null;
        $this->ouverture = null;
        $this->type_liaison = TypeLiaison::REFEND_MUR;
        return $this;
    }

    /**
     * Met à jour une liaison entre un mur et une ouverture
     */
    public function set_liaison_menuiserie_mur(
        \Stringable $reference_ouverture,
        \Stringable $reference_mur,
    ): self {
        if (null === $mur = $this->enveloppe->mur_collection()->find($reference_mur)) {
            throw new \InvalidArgumentException("Mur $reference_mur not found");
        }
        if (null === $ouverture = $this->enveloppe->paroi_collection()->search_ouverture()->find($reference_ouverture)) {
            throw new \InvalidArgumentException("Ouverture $reference_ouverture not found");
        }
        $this->mur = $mur;
        $this->ouverture = $ouverture;
        $this->plancher = null;
        $this->refend = null;
        $this->type_liaison = TypeLiaison::MENUISERIE_MUR;
        return $this;
    }

    public function reference(): \Stringable
    {
        return $this->reference;
    }

    public function enveloppe(): Enveloppe
    {
        return $this->enveloppe;
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
