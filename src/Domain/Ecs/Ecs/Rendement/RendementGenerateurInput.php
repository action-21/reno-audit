<?php

namespace App\Domain\Moteur3CL\Ecs\Rendement;

use App\Domain\Common\Enum\Ecs\{BouclageReseau, TypeGenerateur, TypeInstallation};
use App\Domain\Audit\Enum\ScenarioUsage;

interface RendementGenerateurInput
{
    /**
     * Type d'installation
     */
    public function type_installation(): TypeInstallation;

    /**
     * Bouclage du réseau collectif
     */
    public function bouclage_reseau(): ?BouclageReseau;

    /**
     * Type de générateur
     */
    public function type_generateur(): TypeGenerateur;

    /**
     * Production en volume habitable
     */
    public function position_volume_habitable(): bool;

    /**
     * Pièces alimentées contiguës
     */
    public function alimentation_contigue(): bool;

    /**
     * Vs - volume du ballon de stockage (litres)
     */
    public function volume_stockage(): float;

    /**
     * Besoin annuel d'eau chaude sanitaire (Wh)
     * 
     * @see \App\Domain\Moteur3CL\Ecs\BesoinEcs
     */
    public function becs(ScenarioUsage $scenario): float;
}
