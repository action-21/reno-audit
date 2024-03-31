<?php

namespace App\Domain\Batiment\Engine;

use App\Domain\Batiment\Batiment;
use App\Domain\Batiment\Table\{SollicitationExterieureCollection, SollicitationExterieureRepository};
use App\Domain\Batiment\Table\{Tbase, TbaseRepository};
use App\Domain\Common\Enum\Mois;

/**
 * @see §11.1
 */
final class Situation
{
    private Batiment $input;
    private ?Tbase $table_tbase = null;
    private ?SollicitationExterieureCollection $table_ext = null;

    public function __construct(
        private SollicitationExterieureRepository $table_ext_repository,
        private TbaseRepository $table_tbase_repository,
    ) {
    }

    /**
     * Epv - Ensoleillement en kWh/m² pour le mois j (kWh/m²)
     */
    public function epv_j(Mois $mois): ?float
    {
        return $this->table_ext_collection()->get($mois)?->epv;
    }

    /**
     * E,j - Ensoleillement reçupar une paroi verticale orientée au sud en absence d'ombrage sur le mois j (kWh/m²)
     */
    public function e_j(Mois $mois): ?float
    {
        return $this->table_ext_collection()->get($mois)?->e;
    }

    /**
     * Efr,j - Ensoleillement reçu en période de refroidissement sur le mois j (kWh/m²)
     * 
     * @todo Vérifier la méthode (coquille ?)
     */
    public function e_fr_j(Mois $mois, bool $scenario_depensier = false): ?float
    {
        return $scenario_depensier
            ? $this->table_ext_collection()->get($mois)?->efr26
            : $this->table_ext_collection()->get($mois)?->efr28;
    }

    /**
     * DH21,j - Degrés-heures de chauffage sur le mois j (°C.h)
     */
    public function dh_ch_j(Mois $mois, bool $scenario_depensier = false): ?float
    {
        return $scenario_depensier
            ? $this->table_ext_collection()->get($mois)?->dh21
            : $this->table_ext_collection()->get($mois)?->dh19;
    }

    /**
     * Nref,j - Nombre d'heures de chauffage sur le mois j (h)
     */
    public function nref_ch_j(Mois $mois, bool $scenario_depensier = false): ?float
    {
        return $scenario_depensier
            ? $this->table_ext_collection()->get($mois)?->nref21
            : $this->table_ext_collection()->get($mois)?->nref19;
    }

    /**
     * Nref,fr,j - Nombre d'heures de refroidissement sur le mois j (h)
     */
    public function nref_fr_j(Mois $mois, bool $scenario_depensier = false): ?float
    {
        return $scenario_depensier
            ? $this->table_ext_collection()->get($mois)?->nref26
            : $this->table_ext_collection()->get($mois)?->nref28;
    }

    /**
     * Text,clim,j - Température extérieure moyenne en période de refroidissement sur le mois j (C°)
     */
    public function text_moy_clim_j(Mois $mois, bool $scenario_depensier = false): ?float
    {
        return $scenario_depensier
            ? $this->table_ext_collection()->get($mois)?->textmoy_clim26
            : $this->table_ext_collection()->get($mois)?->textmoy_clim28;
    }

    /**
     * tefs,j - Température moyenne d'eau froide sanitaire sur le mois j (°C)
     */
    public function tefs(Mois $mois): ?float
    {
        return $this->table_ext_collection()->get($mois)?->tefs;
    }

    /**
     * Valeurs de la table ext
     */
    public function table_ext_collection(): SollicitationExterieureCollection
    {
        return $this->table_ext;
    }

    /**
     * Valeurs de la table tbase
     */
    public function table_tbase(): ?Tbase
    {
        return $this->table_tbase;
    }

    public function input(): Batiment
    {
        return $this->input;
    }

    public function __invoke(Batiment $input): self
    {
        $this->input = $input;

        $this->table_tbase = $this->table_tbase_repository->find(
            zone_climatique: $this->input->adresse()->zone_climatique,
            classe_altitude: $this->input->caracteristique()->classe_altitude,
        );
        $this->table_ext = $this->table_ext_repository->search(
            zone_climatique: $this->input->adresse()->zone_climatique,
            classe_altitude: $this->input->caracteristique()->classe_altitude,
            parois_anciennes_lourdes: $this->input->parois_anciennes_lourdes()
        );

        return $this;
    }
}
