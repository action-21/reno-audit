<?php

namespace App\Domain\Moteur3CL\Refroidissement;

use App\Domain\Moteur3CL\Common\{DataStore, Mois};
use App\Domain\Moteur3CL\Refroidissement\Table\{Seer, SeerRepository};

/**
 * @see §10.3
 */
final class Climatisation
{
    use DataStore;

    private ClimatisationInput $input;

    public function __construct(
        private SeerRepository $table_seer_repository
    ) {
    }

    /**
     * Cfr,gen - Consommation annuelle de refroidissement de l'équipement (kWh)
     */
    public function cfr(bool $scenario_depensier = false, bool $energie_primaire = false): float
    {
        $cfr = \array_reduce(Mois::cases(), fn (Mois $mois, float $cfr): float => $cfr += $this->cfr_j($mois, $scenario_depensier), 0);
        $cfr *= $energie_primaire ? $this->input->type_energie()->facteur_energie_primaire() : 1;

        return $cfr;
    }

    /**
     * Cfr,gen,j - Consommation de refroidissement de l'équipement pour le mois j (kWh)
     */
    public function cfr_j(Mois $mois, bool $scenario_depensier = false): float
    {
        $cfr = ($eer = $this->eer()) ? 0.9 * ($this->input->bfr_j($mois, $scenario_depensier) / $eer) : 0;
        $cfr *= $this->input->ratio_surface();

        return $cfr;
    }

    /**
     * EER - Coefficient d'efficience énergétique
     */
    public function eer(): ?float
    {
        return $this->input->seer_saisi() ? $this->input->seer_saisi() * 0.95 : $this->table_seer()?->eer();
    }

    /**
     * Valeur de la table seer
     */
    public function table_seer(): ?Seer
    {
        return $this->has('table_seer')
            ? $this->get('table_seer')
            : $this->set('table_seer', $this->table_seer_repository->find(
                zone_climatique: $this->input->zone_climatique(),
                periode_installation: $this->input->periode_installation()
            ));
    }

    public function __invoke(ClimatisationInput $input): self
    {
        $this->input = $input;

        return $this;
    }
}
