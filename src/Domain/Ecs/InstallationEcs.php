<?php

namespace App\Domain\Ecs;

use App\Domain\Ecs\Entity\Generateur;
use App\Domain\Ecs\Enum\{BouclageReseau, ConfigurationInstallation, TypeInstallation, TypeInstallationSolaire};

/**
 * @property ?bool $pieces_contigues Donnée d'entrée non couverte par le modèle DPEv2.2
 * @property Generateur[] $generateur_ecs_collection
 */
class InstallationEcs
{
    public function __construct(
        private readonly string $reference,
        private readonly string $reference_logement,
        private ?string $description,
        private ?float $surface_habitable,
        private ?float $nombre_logement,
        private ?float $rdim,
        private ?float $fecs_saisi,
        private ?int $nombre_niveau_installation_ecs,
        private ?bool $reseau_distribution_isole,
        private ?bool $pieces_contigues,
        private ?TypeInstallation $enum_type_installation,
        private ?TypeInstallationSolaire $enum_type_installation_solaire,
        private ?ConfigurationInstallation $enum_cfg_installation_ecs,
        private ?BouclageReseau $enum_bouclage_reseau_ecs,
        private array $generateur_ecs_collection
    ) {
    }

    public function reference(): string
    {
        return $this->reference;
    }

    public function reference_logement(): string
    {
        return $this->reference_logement;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function reseau_distribution_isole(): ?bool
    {
        return $this->reseau_distribution_isole;
    }

    public function pieces_contigues(): ?bool
    {
        return $this->pieces_contigues;
    }

    public function fecs_saisi(): ?float
    {
        return $this->fecs_saisi;
    }

    public function logements(): ?int
    {
        return $this->nombre_logement;
    }

    public function surface_habitable(): ?float
    {
        return $this->surface_habitable;
    }

    public function type_installation(): ?TypeInstallation
    {
        return $this->enum_type_installation;
    }

    public function configuration_installation(): ?ConfigurationInstallation
    {
        return $this->enum_cfg_installation_ecs;
    }

    public function type_installation_solaire(): ?TypeInstallationSolaire
    {
        return $this->enum_type_installation_solaire;
    }

    public function type_bouclage(): ?BouclageReseau
    {
        return $this->enum_bouclage_reseau_ecs;
    }
}
