<?php

namespace App\Domain\Chauffage\Entity;

use App\Domain\Chauffage\Enum\{EquipementIntermittence, LienGenerateurEmetteur, PeriodeInstallationEmetteur};
use App\Domain\Chauffage\Enum\{TemperatureDistribution, TypeChauffage, TypeDistribution, TypeEmissionDistribution, TypeRegulation};

final class Emetteur
{
    public function __construct(
        private readonly string $reference,
        private readonly string $reference_installation,
        private ?string $description,
        private ?float $surface_chauffee,
        private ?bool $reseau_distribution_isole,
        private ?TypeEmissionDistribution $enum_type_emission_distribution,
        private ?TypeDistribution $enum_type_distribution,
        private ?EquipementIntermittence $enum_equipement_intermittence,
        private ?TypeRegulation $enum_type_regulation,
        private ?PeriodeInstallationEmetteur $enum_periode_installation_emetteur,
        private ?TypeChauffage $enum_type_chauffage,
        private ?TemperatureDistribution $enum_temp_distribution_ch,
        private ?LienGenerateurEmetteur $enum_lien_generateur_emetteur
    ) {
    }

    public function reference(): string
    {
        return $this->reference;
    }

    public function reference_installation(): string
    {
        return $this->reference_installation;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function surface_chauffee(): ?float
    {
        return $this->surface_chauffee;
    }

    public function reseau_distribution_isole(): ?bool
    {
        return $this->reseau_distribution_isole;
    }

    public function type_chauffage(): ?TypeChauffage
    {
        return $this->enum_type_chauffage;
    }

    public function temperature_distribution(): ?TemperatureDistribution
    {
        return $this->enum_temp_distribution_ch;
    }

    public function type_regulation(): ?TypeRegulation
    {
        return $this->enum_type_regulation;
    }

    public function type_distribution(): ?TypeDistribution
    {
        return $this->enum_type_distribution;
    }

    public function type_emission_distribution(): ?TypeEmissionDistribution
    {
        return $this->enum_type_emission_distribution;
    }

    public function periode_installation(): ?PeriodeInstallationEmetteur
    {
        return $this->enum_periode_installation_emetteur;
    }

    public function lien_generateur_emetteur(): ?LienGenerateurEmetteur
    {
        return $this->enum_lien_generateur_emetteur;
    }

    public function equipement_intermittence(): ?EquipementIntermittence
    {
        return $this->enum_equipement_intermittence;
    }
}
