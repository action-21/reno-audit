<?php

namespace App\Domain\PontThermique;

use App\Domain\Batiment\Batiment;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\PontThermique\ValueObject\{Caracteristique, Performance};

final class PontThermiqueBuilder
{
    private ?PontThermique $entity = null;

    public function create(
        Batiment $batiment,
        string $description,
        Caracteristique $caracteristique,
        Performance $performance,
    ): void {
        $this->entity = new PontThermique(
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
    }

    public function build_liaison_plancher_bas_mur(\Stringable $reference_plancher, \Stringable $reference_mur,): PontThermique
    {
        if (null === $this->entity) {
            throw new \InvalidArgumentException("Builder should be initialized first");
        }
        return $this->entity->set_liaison_plancher_bas_mur(
            reference_plancher: $reference_plancher,
            reference_mur: $reference_mur,
        );
    }

    public function build_liaison_plancher_intermediaire_mur(\Stringable $reference_plancher, \Stringable $reference_mur,): PontThermique
    {
        if (null === $this->entity) {
            throw new \InvalidArgumentException("Builder should be initialized first");
        }
        return $this->entity->set_liaison_plancher_intermediaire_mur(
            reference_plancher: $reference_plancher,
            reference_mur: $reference_mur,
        );
    }

    public function build_liaison_plancher_haut_mur(\Stringable $reference_plancher, \Stringable $reference_mur,): PontThermique
    {
        if (null === $this->entity) {
            throw new \InvalidArgumentException("Builder should be initialized first");
        }
        return $this->entity->set_liaison_plancher_haut_mur(
            reference_plancher: $reference_plancher,
            reference_mur: $reference_mur,
        );
    }

    public function build_liaision_refend_mur(\Stringable $reference_refend, \Stringable $reference_mur,): PontThermique
    {
        if (null === $this->entity) {
            throw new \InvalidArgumentException("Builder should be initialized first");
        }
        return $this->entity->set_liaison_refend_mur(
            reference_refend: $reference_refend,
            reference_mur: $reference_mur,
        );
    }

    public function build_liaison_menuiserie_mur(\Stringable $reference_ouverture, \Stringable $reference_mur,): PontThermique
    {
        if (null === $this->entity) {
            throw new \InvalidArgumentException("Builder should be initialized first");
        }
        return $this->entity->set_liaison_menuiserie_mur(
            reference_ouverture: $reference_ouverture,
            reference_mur: $reference_mur,
        );
    }
}
