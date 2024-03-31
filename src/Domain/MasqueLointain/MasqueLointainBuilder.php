<?php

namespace App\Domain\MasqueLointain;

use App\Domain\Batiment\Batiment;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\MasqueLointain\Enum\{Orientation, SecteurMasque};

final class MasqueLointainBuilder
{
    private ?MasqueLointain $masque_lointain = null;

    public function create(Batiment $batiment, string $description, float $hauteur_alpha, Orientation $orientation): void
    {
        $this->masque_lointain = new MasqueLointain(
            reference: Uuid::create(),
            batiment: $batiment,
            description: $description,
            hauteur_alpha: $hauteur_alpha,
            orientation: $orientation,
            secteur: null,
        );
    }

    public function build_masque_lointain_homogene(): MasqueLointain
    {
        return $this->masque_lointain->set_masque_lointain_homogene();
    }

    public function build_masque_lointain_non_homogene(SecteurMasque $secteur): MasqueLointain
    {
        return $this->masque_lointain->set_masque_lointain_non_homogene(secteur: $secteur);
    }
}
