<?php

namespace App\Domain\Ecs\Entity;

use App\Domain\Common\Enum\TypeEnergie;
use App\Domain\Ecs\Enum\{MethodeSaisieCaracteristiquesSysteme, PeriodeInstallationGenerateur, TypeBallonElectrique, TypeGenerateur, TypeStockage, UsageGenerateur};

/**
 * @property ?PeriodeInstallationGenerateurEcs $enum_periode_installation_generateur_ecs Données absente du modèle de données DPEv2.2
 * @property ?TypeBallonElectrique $enum_type_ballon_electrique Données absente du modèle de données DPEv2.2
 * @property ?float $cop_saisi Données absente du modèle de données DPEv2.2
 */
class Generateur
{
    public function __construct(
        private readonly string $reference,
        private readonly string $reference_installation,
        private ?string $reference_generateur_mixte,
        private ?string $identifiant_reseau_chaleur,
        private ?string $description,
        private ?float $volume_stockage,
        private ?float $pn_saisi,
        private ?float $rpn_saisi,
        private ?float $rpint_saisi,
        private ?float $qp0_saisi,
        private ?float $pveilleuse_saisi,
        private ?float $cop_saisi,
        private ?bool $position_volume_chauffe,
        private ?bool $position_volume_chauffe_stockage,
        private ?bool $presence_ventouse,
        private ?MethodeSaisieCaracteristiquesSysteme $enum_methode_saisie_carac_sys,
        private ?TypeGenerateur $enum_type_generateur_ecs,
        private ?PeriodeInstallationGenerateur $enum_periode_installation_generateur_ecs,
        private ?UsageGenerateur $enum_usage_generateur,
        private ?TypeEnergie $enum_type_energie,
        private ?TypeStockage $enum_type_stockage_ecs,
        private ?TypeBallonElectrique $enum_type_ballon_electrique
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

    public function reseau_chaleur(): ?string
    {
        return $this->identifiant_reseau_chaleur;
    }

    public function cop_saisi(): ?float
    {
        return $this->cop_saisi;
    }

    public function volume_stockage(): ?float
    {
        return $this->volume_stockage;
    }

    public function position_volume_chauffe(): ?bool
    {
        return $this->position_volume_chauffe;
    }

    public function position_volume_chauffe_stockage(): ?bool
    {
        return $this->position_volume_chauffe_stockage;
    }

    public function presence_ventouse(): ?bool
    {
        return $this->presence_ventouse;
    }

    public function pn_saisi(): ?float
    {
        return $this->pn_saisi;
    }

    public function qp0_saisi(): ?float
    {
        return $this->qp0_saisi;
    }

    public function rpn_saisi(): ?float
    {
        return $this->rpn_saisi;
    }

    public function rpint_saisi(): ?float
    {
        return $this->rpint_saisi;
    }

    public function pveilleuse_saisi(): ?float
    {
        return $this->pveilleuse_saisi;
    }

    public function type_generateur(): ?TypeGenerateur
    {
        return $this->enum_type_generateur_ecs;
    }

    public function usage_generateur(): ?UsageGenerateur
    {
        return $this->enum_usage_generateur;
    }

    public function periode_installation(): ?PeriodeInstallationGenerateur
    {
        return $this->enum_periode_installation_generateur_ecs;
    }

    public function type_stockage(): ?TypeStockage
    {
        return $this->enum_type_stockage_ecs;
    }

    public function type_ballon_electrique(): ?TypeBallonElectrique
    {
        return $this->enum_type_ballon_electrique ?? $this->enum_type_generateur_ecs?->type_ballon_electrique_defaut();
    }

    public function type_energie(): ?TypeEnergie
    {
        return $this->enum_type_energie;
    }

    public function methode_saisie_caracteristiques(): ?MethodeSaisieCaracteristiquesSysteme
    {
        return $this->enum_methode_saisie_carac_sys;
    }
}
