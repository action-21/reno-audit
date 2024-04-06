<?php

namespace App\Domain\Batiment\Engine;

use App\Domain\Batiment\BatimentEngine;
use App\Domain\Batiment\Table\{NheclCollection, NheclRepository};
use App\Domain\Common\Enum\Mois;

/**
 * @see §16.1
 * @see §16.2
 */
final class Eclairage
{
    private BatimentEngine $context;
    private ?NheclCollection $table_nh_collection = null;

    /**
     * Nombre d'heures d'inoccupation conventionnel sur une semaine (h)
     */
    final public const PERIODE_INOCCUPATION_HEBDOMADAIRE = 36;

    /**
     * Puissance d’éclairage conventionnelle (W/m2)
     */
    final public const PUISSANCE_ECLAIRAGE = 1.4;

    /**
     * Coefficient correspondant au taux d'utilisation de l'éclairage en l'absence d'éclairage naturel
     */
    final public const COEFFICIENT_ECLAIRAGE_C = 0.9;

    public function __construct(
        private NheclRepository $table_nh_repository,
    ) {
    }

    /**
     * Cecl - Consommation annuelle d'éclairage (kWh)
     */
    public function cecl(): ?float
    {
        return \array_reduce(Mois::cases(), fn (Mois $mois, float $cecl): float => $cecl += $this->cecl_j($mois), 0);
    }

    /**
     * Cecl,j - Consommation d'éclairage pour le mois j (kWh)
     */
    public function cecl_j(Mois $mois): ?float
    {
        $cecl_j = self::COEFFICIENT_ECLAIRAGE_C * self::PUISSANCE_ECLAIRAGE * $this->becl_j($mois);
        $cecl_j *= $this->context->input()->caracteristique()->surface_habitable_moyenne();
        return $cecl_j / 1000;
    }

    /**
     * Besoin annuel d'éclairage (h)
     */
    public function becl(): float
    {
        return \array_reduce(Mois::cases(), fn (Mois $mois, float $becl): float => $becl += (float) $this->becl_j($mois), 0);
    }

    /**
     * Besoin d'éclairage pour le mois j (h)
     */
    public function becl_j(Mois $mois): float
    {
        return $this->table_nh_collection()->get($mois)?->nh_j() ?? 0;
    }

    /**
     * Valeurs de la table nhecl
     */
    public function table_nh_collection(): NheclCollection
    {
        return $this->table_nh_collection;
    }

    public function __invoke(BatimentEngine $context): self
    {
        $this->context = $context;

        $this->table_nh_collection = $this->table_nh_repository->search(
            zone_climatique: $context->input()->adresse()->zone_climatique,
        );

        return $this;
    }
}
