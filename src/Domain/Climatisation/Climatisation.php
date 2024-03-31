<?php

namespace App\Domain\Climatisation;

use App\Domain\Audit\Enum\TypeEnergie;
use App\Domain\Climatisation\Enum\{MethodeSaisieCaracteristiques, PeriodeInstallation, TypeGenerateur};
use App\Domain\Common\Identifier\Uuid;
use App\Domain\Logement\Logement;

/**
 * La collecte des installation de climatisation admet plusieurs générateurs par installation
 */
final class Climatisation
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Logement $logement,
        private ?string $description,
        private float $surface,
        private ?float $seer_saisie,
        private MethodeSaisieCaracteristiques $methode_saisie_caractersitiques,
        private TypeGenerateur $type_generateur,
        private PeriodeInstallation $periode_installation,
        private ?TypeEnergie $type_energie,
    ) {
    }

    public static function create(
        Logement $logement,
        ?string $description,
        float $surface,
        ?float $seer_saisie,
        MethodeSaisieCaracteristiques $methode_saisie_caractersitiques,
        TypeGenerateur $type_generateur,
        PeriodeInstallation $periode_installation,
        ?TypeEnergie $type_energie,
    ): self {
        return new self(
            reference: Uuid::create(),
            logement: $logement,
            description: $description,
            surface: $surface,
            seer_saisie: $seer_saisie,
            methode_saisie_caractersitiques: $methode_saisie_caractersitiques,
            type_generateur: $type_generateur,
            periode_installation: $periode_installation,
            type_energie: $type_energie,
        );
    }

    public function reference(): \Stringable
    {
        return $this->reference;
    }

    public function logement(): Logement
    {
        return $this->logement;
    }

    /**
     * Description du système
     */
    public function description(): ?string
    {
        return $this->description;
    }

    /**
     * Surface climatisée (m²)
     */
    public function surface(): float
    {
        return $this->surface;
    }

    /**
     * Ratio de surface climatisée
     */
    public function ratio_surface(): float
    {
        return $this->logement()->surface_habitable() ? $this->surface() / $this->logement()->surface_habitable() : 0;
    }

    /**
     * Performance saisie du générateur de froid
     */
    public function seer_saisie(): ?float
    {
        return $this->seer_saisie;
    }

    /**
     * Type du générateur de froid
     */
    public function type_generateur(): TypeGenerateur
    {
        return $this->type_generateur;
    }

    /**
     * Période d'installation du générateur de froid
     */
    public function periode_installation(): PeriodeInstallation
    {
        return $this->periode_installation;
    }

    /**
     * Type d'énergie utilisée par le générateur de froid
     */
    public function type_energie(): ?TypeEnergie
    {
        return $this->type_energie;
    }
}
