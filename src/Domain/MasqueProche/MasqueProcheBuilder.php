<?php

namespace App\Domain\MasqueProche;

use App\Domain\Enveloppe\Enveloppe;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\MasqueProche\Enum\Orientation;

final class MasqueProcheBuilder
{
    private ?MasqueProche $masque_proche = null;

    /**
     * Initialise un masque proche
     */
    public function create(Enveloppe $enveloppe, string $description): void
    {
        $this->masque_proche = new MasqueProche(
            reference: Uuid::create(),
            enveloppe: $enveloppe,
            description: $description,
            avancee: null,
            orientation: null,
        );
    }

    /**
     * Construit un masque proche de type baie en fond de balcon ou fond et flanc de loggias
     */
    public function build_fond_balcon_ou_fond_flanc_loggias(float $avancee, Orientation $orientation): MasqueProche
    {
        return $this->masque_proche->set_fond_balcon_ou_fond_flanc_loggias(avancee: $avancee, orientation: $orientation);
    }

    /**
     * Construit un masque proche de type baie sous un balcon ou auvent
     */
    public function build_balcon_ou_auvent(float $avancee): MasqueProche
    {
        return $this->masque_proche->set_balcon_ou_auvent(avancee: $avancee);
    }

    /**
     * Construit un masque proche de type baie masquée par une paroi latérale
     */
    public function build_paroi_laterale(bool $obstacle_au_sud): MasqueProche
    {
        return $this->masque_proche->set_paroi_laterale(obstacle_au_sud: $obstacle_au_sud);
    }
}
