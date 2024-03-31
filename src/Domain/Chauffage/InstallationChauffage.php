<?php

namespace App\Domain\Chauffage;

use App\Domain\Chauffage\Entity\{Emetteur, Generateur};
use App\Domain\Chauffage\Enum\{ConfigurationInstallation, TypeInstallation};

/**
 * @property $comptage_individuel absent du modèle de données DPEv2.2 - Requis pour la prise en compte de tv_intermittence
 * @property $generateurs Generateur[]
 * @property $generateurs Emetteur[]
 */
final class InstallationChauffage
{
    public function __construct(
        private readonly string $reference,
        private readonly string $reference_logement,
        private ?string $description,
        private ?float $surface_chauffee,
        private ?float $fch_saisi,
        private ?float $nombre_logement_echantillon,
        private ?int $nombre_niveau_installation_ch,
        private ?bool $comptage_individuel,
        private ?TypeInstallation $enum_type_installation,
        private ?ConfigurationInstallation $enum_cfg_installation_ch,
        private array $generateurs,
        private array $emetteurs
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

    public function logements_echantillon(): ?int
    {
        return $this->nombre_logement_echantillon;
    }

    public function surface_chauffee(): ?float
    {
        return $this->surface_chauffee;
    }

    public function fch_saisi(): ?float
    {
        return $this->fch_saisi;
    }

    public function logements(): ?int
    {
        return $this->nombre_logement_echantillon;
    }

    public function comptage_individuel(): ?bool
    {
        return $this->comptage_individuel;
    }

    public function type_installation(): ?TypeInstallation
    {
        return $this->enum_type_installation;
    }

    public function configuration_installation(): ?ConfigurationInstallation
    {
        return $this->enum_cfg_installation_ch;
    }

    /**
     * @return Generateur[]
     */
    public function generateurs(): array
    {
        return $this->generateurs;
    }

    /**
     * @return Emetteur[]
     */
    public function emetteurs(): array
    {
        return $this->emetteurs;
    }
}
