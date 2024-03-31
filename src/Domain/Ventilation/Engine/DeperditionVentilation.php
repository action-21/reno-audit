<?php

namespace App\Domain\Moteur3CL\Deperdition\Ventilation;

use App\Domain\Moteur3CL\Common\DataStore;
use App\Domain\Moteur3CL\Deperdition\Ventilation\Table\{Debit, DebitRepository, Q4paConv, Q4paConvRepository};

/**
 * @see §4
 */
final class DeperditionVentilation
{
    use DataStore;

    private DeperditionVentilationInput $input;

    public function __construct(
        private DebitRepository $table_debit_repository,
        private Q4paConvRepository $table_q4pa_conv_repository,

    ) {
    }

    /**
     * Déperdition thermique par renouvellement (W/K)
     */
    public function dr(): ?float
    {
        return $this->hperm() + $this->hvent();
    }

    /**
     * Déperdition thermique par renouvellement d’air due au vent (W/K)
     */
    public function hperm(): ?float
    {
        return 0.34 * $this->qvinf();
    }

    /**
     * Déperdition thermique par renouvellement d’air due au système de ventilation (W/K)
     */
    public function hvent(): ?float
    {
        return 0.34 * $this->input->surface_habitable() * $this->qvarep_conv();
    }

    /**
     * Débit d’air dû aux infiltrations liées au vent (m3/h)
     */
    public function qvinf(): ?float
    {
        if (0 >= $n50 = $this->n50()) {
            return null;
        }
        $hsp = $this->input->hsp();
        $sh = $this->input->surface_habitable();
        $e = $this->input->exposition()->coefficient_e();
        $f = $this->input->exposition()->coefficient_f();
        $qvasouf_conv = $this->qvasouf_conv();
        $qvarep_conv = $this->qvarep_conv();

        return ($hsp * $sh * $n50 * $e) / (1 + ($f / $e) * \pow(($qvasouf_conv - $qvarep_conv) / ($hsp * $n50), 2));
    }


    /**
     * Renouvellement d’air sous 50 Pascals (h-1)
     */
    public function n50(): ?float
    {
        return ($volume = $this->input->volume()) > 0 ? $this->q4pa() / (\pow(4 / 50, 2 / 3) * $volume) : null;
    }

    /**
     * Perméabilité sous 4 Pa de la zone (m3/h)
     */
    public function q4pa(): ?float
    {
        return $this->q4paenv() + 0.45 * $this->smea_conv() * $this->input->surface_habitable();
    }

    /**
     * Perméabilité de l’enveloppe (m3/h)
     */
    public function q4paenv(): ?float
    {
        return $this->q4pa_conv() * $this->input->sdep();
    }

    /**
     * Valeur conventionnelle de la perméabilité sous 4Pa (m3/(h.m2))
     */
    public function q4pa_conv(): ?float
    {
        return $this->input->q4pa_conv_saisi() ?? $this->table_q4pa_conv()?->q4pa_conv();
    }

    /**
     * Débit volumique conventionnel à reprendre (m3/(h.m²))
     */
    public function qvarep_conv(): ?float
    {
        return $this->table_debit()?->qvarep_conv();
    }

    /**
     * Débit volumique conventionnel à souffler (m3/(h.m²))
     */
    public function qvasouf_conv(): ?float
    {
        return $this->table_debit()?->qvasouf_conv();
    }

    /**
     * Somme des modules d’entrée d’air sous 20 Pa par unité de surface habitable (m3/(h.m2))
     */
    public function smea_conv(): ?float
    {
        return $this->table_debit()?->smea_conv();
    }

    /**
     * Valeur de la table utilisée pour le calcul des débits
     */
    public function table_debit(): ?Debit
    {
        return $this->has('table_debit')
            ? $this->get('table_debit')
            : $this->set('table_debit', $this->table_debit_repository->find(
                type_ventilation: $this->input->type_ventilation()
            ));
    }

    /**
     * Valeur de la table utilisée pour le calcul de q4pa_conv
     */
    public function table_q4pa_conv(): ?Q4paConv
    {
        return $this->has('table_q4pa_conv')
            ? $this->get('table_q4pa_conv')
            : $this->set('table_q4pa_conv', $this->table_q4pa_conv_repository->find(
                type_batiment: $this->input->type_batiment(),
                periode_construction: $this->input->periode_construction(),
                presence_joints_menuiserie: $this->input->presence_joint(),
                isolation_murs_plafonds: $this->input->isolation_murs_plafonds(),
            ));
    }

    public function __invoke(DeperditionVentilationInput $input): self
    {
        $this->input = $input;

        return $this;
    }
}
