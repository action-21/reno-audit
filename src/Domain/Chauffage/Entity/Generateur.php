<?php

namespace App\Domain\Chauffage\Entity;

use App\Domain\Chauffage\Enum\{LienGenerateurEmetteur, MethodeSaisieCaracteristiquesSysteme, PeriodeInstallationGenerateur, TypeGenerateur, UsageGenerateur};
use App\Domain\Common\Enum\TypeEnergie;

final class Generateur
{
    public function __construct(
        private readonly ?string $reference,
        private readonly ?string $reference_installation,
        private ?string $reference_generateur_mixte,
        private ?string $identifiant_reseau_chaleur,
        private ?string $description,
        private ?float $pn_saisi,
        private ?float $rpn_saisi,
        private ?float $rpint_saisi,
        private ?float $qp0_saisi,
        private ?float $pveilleuse_saisi,
        private ?float $scop_saisi,
        private ?int $n_radiateurs_gaz,
        private ?int $priorite_generateur_cascade,
        private ?bool $position_volume_chauffe,
        private ?bool $presence_ventouse,
        private ?bool $presence_regulation_combustion,
        private ?MethodeSaisieCaracteristiquesSysteme $enum_methode_saisie_carac_sys,
        private ?TypeGenerateur $enum_type_generateur_ch,
        private ?PeriodeInstallationGenerateur $enum_periode_installation_generateur_ch,
        private ?UsageGenerateur $enum_usage_generateur,
        private ?TypeEnergie $enum_type_energie,
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

    public function reference_generateur_mixte(): ?string
    {
        return $this->reference_generateur_mixte;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function reseau_chaleur(): ?string
    {
        return $this->identifiant_reseau_chaleur;
    }

    public function nombre(): ?int
    {
        return $this->n_radiateurs_gaz;
    }

    public function priorite_cascade(): ?bool
    {
        return $this->priorite_generateur_cascade === 1;
    }

    public function position_volume_chauffe(): ?bool
    {
        return $this->position_volume_chauffe;
    }

    public function presence_ventouse(): ?bool
    {
        return $this->presence_ventouse;
    }

    public function regulation_combustion(): ?bool
    {
        return $this->presence_regulation_combustion;
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

    public function scop_saisi(): ?float
    {
        return $this->scop_saisi;
    }

    public function type_generateur(): ?TypeGenerateur
    {
        return $this->enum_type_generateur_ch;
    }

    public function usage_generateur(): ?UsageGenerateur
    {
        return $this->enum_usage_generateur;
    }

    public function periode_installation(): ?PeriodeInstallationGenerateur
    {
        return $this->enum_periode_installation_generateur_ch;
    }

    public function lien_generateur_emetteur(): ?LienGenerateurEmetteur
    {
        return $this->enum_lien_generateur_emetteur;
    }

    public function methode_saisie_caracteristiques(): ?MethodeSaisieCaracteristiquesSysteme
    {
        return $this->enum_methode_saisie_carac_sys;
    }

    public function type_energie(): ?TypeEnergie
    {
        return $this->enum_type_energie;
    }
}
