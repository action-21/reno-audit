<?php

namespace App\Domain\Ventilation;

use App\Domain\Logement\Logement;
use App\Domain\Common\Enum\Situation\{PeriodeConstruction, TypeBatiment};
use App\Domain\Audit\Enum\TypeEnergie;
use App\Domain\Ventilation\Enum\{ConfigurationExposition, MethodeSaisieQ4paConv, TypeVentilation};

final class Ventilation
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Logement $logement,
        private ?string $description,
        private ?float $q4pa_conv_saisi,
        private ConfigurationExposition $exposition,
        private MethodeSaisieQ4paConv $methode_saisie,
        private TypeVentilation $type_ventilation,
    ) {
    }

    /**
     * Identifiant unique du système de ventilation
     */
    public function reference(): \Stringable
    {
        return $this->reference;
    }

    /**
     * Logement rattaché au système de ventilation
     */
    public function logement(): Logement
    {
        return $this->logement;
    }

    /**
     * Description libre du système de ventilation
     */
    public function description(): ?string
    {
        return $this->description;
    }

    /**
     * Surface ventilée par le système de ventilation
     *      -> Egale à la surface habitable du logement dans le cas d'une seule ventilation
     *      -> Egale à la surface de l'installation dans le cas d'un DPE immeuble ou d'un DPE appartement à partir de l'immeuble
     */
    public function surface_ventile(): float
    {
        return $this->logement()->audit()->ventilation_collection()->count() === 1
            ? $this->logement()->surface_habitable()
            : $this->logement()->audit()->ventilation_collection()->filterByType(type_ventilation: $this->type_ventilation)->surface_ventile();
    }

    /**
     * Volume ventilé par le système de ventilation
     */
    public function volume_ventile(): float
    {
        return $this->surface_ventile() * $this->logement()->hsp();
    }

    /** 
     * Présence majoritaire de joints d'étanchéité au niveau des menuiseries
     */
    public function presence_joint(): bool
    {
        return $this->logement()->ouverture_collection()->presence_joint();
    }

    /**
     * 
     */
    public function isolation_murs_plafonds(): bool
    {
        return $this->logement()->paroi_collection()->withoutOuverture()->withoutPlancherBas()->isolation();
    }

    public function surface_deperditive(): float
    {
        return $this->logement()->paroi_collection()->surface_deperditive() - $this->logement()->plancher_bas_collection()->surface_deperditive();
    }

    public function q4pa_conv_saisi(): ?float
    {
        return $this->q4pa_conv_saisi;
    }

    public function type_batiment(): TypeBatiment
    {
        return $this->logement()->audit()->type_batiment();
    }

    public function periode_construction(): PeriodeConstruction
    {
        return $this->logement()->audit()->periode_construction();
    }

    public function exposition(): ConfigurationExposition
    {
        return $this->exposition;
    }

    public function type_ventilation(): TypeVentilation
    {
        return $this->type_ventilation;
    }

    public function type_energie(): TypeEnergie
    {
        return $this->type_ventilation->type_energie();
    }

    public function methode_saisie(): MethodeSaisieQ4paConv
    {
        return $this->methode_saisie;
    }
}
