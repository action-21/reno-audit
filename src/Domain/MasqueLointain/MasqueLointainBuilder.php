<?php

namespace App\Domain\MasqueLointain;

use App\Domain\Enveloppe\Enveloppe;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\MasqueLointain\Enum\{Orientation, SecteurOrientation};

final class MasqueLointainBuilder
{
    private ?MasqueLointain $masque_lointain = null;

    /**
     * Initialise un masque lointain
     */
    public function create(Enveloppe $enveloppe, string $description, float $hauteur_alpha, Orientation $orientation): void
    {
        $this->masque_lointain = new MasqueLointain(
            reference: Uuid::create(),
            enveloppe: $enveloppe,
            description: $description,
            hauteur_alpha: $hauteur_alpha,
            orientation: $orientation,
            secteur_orientation: null,
        );
    }

    /**
     * Construit un masque lointain homogène
     */
    public function build_masque_lointain_homogene(): MasqueLointain
    {
        return $this->masque_lointain->set_masque_lointain_homogene();
    }

    /**
     * Construit un masque lointain non homogène
     */
    public function build_masque_lointain_non_homogene(SecteurOrientation $secteur_orientation): MasqueLointain
    {
        return $this->masque_lointain->set_masque_lointain_non_homogene(secteur_orientation: $secteur_orientation);
    }
}
