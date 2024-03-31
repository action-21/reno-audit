<?php

namespace App\Domain\Moteur3CL\Ecs\Rendement;

use App\Domain\Common\Enum\Ecs\{BouclageReseau, ConfigurationInstallation, TypeInstallation, TypeInstallationSolaire};

interface RendementInstallationInput
{
    /**
     * Type d'installation
     */
    public function type_installation(): TypeInstallation;

    /**
     * Configuration de l'installation
     */
    public function configuration_installation(): ConfigurationInstallation;

    /**
     * Type d'installation solaire
     */
    public function type_installation_solaire(): ?TypeInstallationSolaire;

    /**
     * Type d'installation solaire
     */
    public function bouclage_reseau(): ?BouclageReseau;

    /**
     * Générateurs de production d'ECS
     * 
     * @return RendementGenerateurInput[]
     */
    public function generateur_collection(): array;

}
