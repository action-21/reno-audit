<?php

namespace App\Domain\Baie\Engine;

use App\Domain\Baie\{Baie, BaieEngine};
use App\Domain\Baie\Table\{C1Collection, C1Repository, Sw, SwRepository};
use App\Domain\Common\Enum\Mois;

/**
 * @see §6.2
 */
final class SseBaie
{
    private Baie $input;
    private BaieEngine $engine;
    private ?SseDoubleFenetre $sse_double_fenetre;
    private ?Sw $table_sw;
    private C1Collection $table_c1_collection;

    public function __construct(
        private SseDoubleFenetre $sse_double_fenetre_engine,
        private SwRepository $table_sw_repository,
        private C1Repository $table_c1_repository,
    ) {
    }

    /**
     * Surface sud équivalente pour le mois j (m²)
     */
    public function sse_j(Mois $mois): float
    {
        return $this->input->local_non_chauffe()?->ets()
            ? $this->ssd_j($mois) + $this->ssind_j($mois) * $this->bver()
            : $this->input->surface_deperditive() * $this->sw() * $this->fe() * $this->c1_j($mois);
    }

    /**
     * Surface sud équivalente représentant les apports solaires indirects dans le logement pour le mois j (m²)
     */
    public function ssind_j(Mois $mois): float
    {
        return \max($this->sst_j($mois) - $this->ssd_j($mois), 0);
    }

    /**
     * Surface sud équivalente des apports dans la véranda pour le mois j
     */
    public function sst_j(Mois $mois): float
    {
        if (!$this->input->local_non_chauffe()?->ets()) {
            return 0;
        }
        return $this
            ->engine
            ->context()
            ->lnc_engine()
            ->surface_sud_equivalente()
            ->sst_j(local_non_chauffe: $this->input->local_non_chauffe(), mois: $mois) ?? 0;
    }

    /**
     * Surface sud équivalente représentant l’impact des apports solaires associés au rayonnement
     * solaire traversant directement l’espace tampon pour arriver dans la partie habitable du logement (m²)
     */
    public function ssd_j(Mois $mois): float
    {
        $sse_j = $this->input->surface_deperditive() * $this->sw() * $this->fe() * $this->c1_j($mois);
        return $sse_j * $this->t() ?? 0;
    }

    /**
     * Sw - Proportion d'énergie solaire incidente qui pénètre dans le logement par la paroi vitrée
     */
    public function sw(): ?float
    {
        return $this->sw1() * $this->sw2();
    }

    /**
     * Sw1 - Proportion d'énergie solaire incidente qui pénètre dans le logement par la paroi vitrée
     */
    public function sw1(): ?float
    {
        return $this->input->performance()->sw_saisi ?? ($this->table_sw()?->sw() ?? 0);
    }

    /**
     * Sw2 - Proportion d'énergie solaire incidente qui pénètre dans le logement par la double fenêtre
     */
    public function sw2(): float
    {
        return $this->sse_double_fenetre()?->sw() ?? 1;
    }

    /**
     * Fe - Facteur de réduction de l'ensoleillement due aux masques
     */
    public function fe(): float
    {
        return $this->fe1() * $this->fe2();
    }

    /**
     * Fe1 - Facteur de réduction de l'ensoleillement due aux masques proches
     */
    public function fe1(): float
    {
        return $this
            ->engine
            ->context()
            ->masque_proche_engine()
            ->facteur_ensoleillement()
            ->fe1($this->input->masque_proche_collection()) ?? 0;
    }

    /**
     * Fe2 - Facteur de réduction de l'ensoleillement due aux masques loitains
     */
    public function fe2(): float
    {
        return $this
            ->engine
            ->context()
            ->masque_lointain_engine()
            ->facteur_ensoleillement()
            ->fe2($this->input->orientation()->value) ?? 0;
    }

    /**
     * Coefficient de transparence de la véranda
     */
    public function t(): float
    {
        if (!$this->input->local_non_chauffe()?->ets()) {
            return 1;
        }
        return $this->engine
            ->context()
            ->lnc_engine()
            ->surface_sud_equivalente()
            ->t($this->input->local_non_chauffe()) ?? 0;
    }

    /**
     * Coefficient de réduction des déperditions thermiques des parois donnant sur un local non chauffé
     */
    public function bver(): float
    {
        if (!$this->input->local_non_chauffe()?->ets()) {
            return 1;
        }
        return $this->engine
            ->context()
            ->lnc_engine()
            ->reduction_deperdition()
            ->b($this->input->local_non_chauffe()) ?? 0;
    }

    /**
     * C1,j - Coefficient d'orientation et d'inclinaison pour le mois j
     */
    public function c1_j(Mois $mois): float
    {
        return $this->table_c1_collection()->c1($mois);
    }

    /**
     * Surface sud équivalente de la double fenêtre
     */
    public function sse_double_fenetre(): ?SseDoubleFenetre
    {
        return $this->sse_double_fenetre;
    }

    public function table_sw(): ?Sw
    {
        return $this->table_sw;
    }

    public function table_c1_collection(): C1Collection
    {
        return $this->table_c1_collection;
    }

    public function input(): Baie
    {
        return $this->input;
    }

    public function __invoke(Baie $input, BaieEngine $engine): self
    {
        $this->input = $input;
        $this->engine = $engine;
        $this->sse_double_fenetre = $input->double_fenetre() ? ($this->sse_double_fenetre_engine)($input->double_fenetre()) : null;

        $this->table_sw = $this->table_sw_repository->find(
            type_baie: $input->caracteristique()->type_baie,
            materiaux_menuiserie: $input->menuiserie()->type_materiaux,
            type_pose: $input->caracteristique()->type_pose,
            type_vitrage: $input->vitrage()->type_vitrage,
            vitrage_vir: $input->vitrage()->vitrage_vir,
        );
        $this->table_c1_collection = $this->table_c1_repository->search(
            zone_climatique: $input->enveloppe()->batiment()->adresse()->zone_climatique,
            orientation: $input->orientation(),
            inclinaison_vitrage: $input->vitrage()->inclinaison_vitrage,
        );

        return $this;
    }
}
