<?php

namespace App\Domain\Moteur3CL\Ventilation;

use App\Domain\Moteur3CL\Common\DataStore;
use App\Domain\Moteur3CL\Ventilation\Table\{Debit, DebitRepository};

/**
 * @see §5
 */
final class ConsommationVentilation
{
    use DataStore;

    private ConsommationVentilationInput $input;

    public function __construct(private DebitRepository $table_debit_repository,)
    {
    }

    /**
     * C,aux - Consommation annuelle d’auxiliaires de ventilation (kWhef/an)
     */
    public function caux(): float
    {
        return 8760 * ($this->pvent() / 1000);
    }

    /**
     * Débit volumique conventionnel à reprendre (m3/(h.m²))
     */
    public function qvarep_conv(): ?float
    {
        return $this->table_debit()?->qvarep_conv();
    }

    /**
     * Puissance moyenne des auxiliaires (W/(m³/h))
     */
    public function pvent_moy(): ?float
    {
        return $this->input->type_ventilation()->pvent_moy() ?? $this->pvent() * $this->qvarep_conv() * $this->input->surface_habitable();
    }

    /**
     * Puissance des auxiliaires (W/(m³/h))
     */
    public function pvent(): ?float
    {
        return $this->input->type_ventilation()->pvent();
    }

    /**
     * Ratio du temps d'utilisation pour les ventilations hybrides (1 par défaut)
     */
    public function ratio_temps_utilisation(): ?float
    {
        return $this->input->type_ventilation()->ratio_temps_utilisation()
            ? $this->input->type_batiment()->ratio_temps_utilisation_ventilation()
            : 1;
    }

    /**
     * Valeurs de la table nhecl
     */
    public function table_debit(): ?Debit
    {
        return $this->has('table_debit')
            ? $this->get('table_debit')
            : $this->set('table_debit', $this->table_debit_repository->find(
                type_ventilation: $this->input->type_ventilation(),
            ));
    }

    public function __invoke(ConsommationVentilationInput $input): self
    {
        $this->input = $input;

        return $this;
    }
}
