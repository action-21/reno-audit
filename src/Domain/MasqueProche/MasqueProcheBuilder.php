<?php

namespace App\Domain\MasqueProche;

use App\Domain\Batiment\Batiment;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\MasqueProche\Enum\Orientation;

final class MasqueProcheBuilder
{
    private ?MasqueProche $masque_proche = null;

    public function create(Batiment $batiment, string $description): void
    {
        $this->masque_proche = new MasqueProche(
            reference: Uuid::create(),
            batiment: $batiment,
            description: $description,
            avancee: null,
            orientation: null,
        );
    }

    /**
     * Baie en fond de balcon ou fond et flanc de loggias
     * 
     * @param float $avancee - Avancée de l'obstacle en m
     * @param Orientation $orientation - Orientation du masque proche
     */
    public function build_fond_balcon_ou_fond_flanc_loggias(float $avancee, Orientation $orientation): MasqueProche
    {
        return $this->masque_proche->set_fond_balcon_ou_fond_flanc_loggias(avancee: $avancee, orientation: $orientation);
    }

    /**
     * Baie sous un balcon ou auvent
     * 
     * @param float $avancee - Avancée de l'obstacle en m
     */
    public function build_balcon_ou_auvent(float $avancee): MasqueProche
    {
        return $this->masque_proche->set_balcon_ou_auvent(avancee: $avancee);
    }

    /**
     * Baie masquée par une paroi latérale
     * 
     * @param bool $obstacle_au_sud - Indique si le masque fait obstacle au sud
     */
    public function build_paroi_laterale(bool $obstacle_au_sud): MasqueProche
    {
        return $this->masque_proche->set_paroi_laterale(obstacle_au_sud: $obstacle_au_sud);
    }
}
