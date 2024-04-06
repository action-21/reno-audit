<?php

namespace App\Domain\Baie\Engine;

use App\Domain\Baie\{Baie, BaieEngine};
use App\Domain\Baie\Table\{UgCollection, UgRepository, UwCollection, UwRepository};
use App\Domain\Baie\Table\{Deltar, DeltarRepository, UjnCollection, UjnRepository};
use App\Domain\Paroi\Enum\QualiteComposant;

/**
 * @see §3.3
 */
final class DeperditionBaie
{
    private Baie $input;
    private BaieEngine $engine;
    private ?DeperditionDoubleFenetre $deperdition_double_fenetre;
    private UgCollection $table_ug_collection;
    private UwCollection $table_uw_collection;
    private ?Deltar $table_deltar;
    private UjnCollection $table_ujn_collection;

    public function __construct(
        private DeperditionDoubleFenetre $deperdition_double_fenetre_engine,
        private UgRepository $table_ug_repository,
        private UwRepository $table_uw_repository,
        private DeltarRepository $table_deltar_repository,
        private UjnRepository $table_ujn_repository,
    ) {
    }

    /**
     * DP,baie - Déperditions thermiques (W/K)
     */
    public function dp(): float
    {
        return $this->u() * $this->sdep() * $this->b();
    }

    /**
     * u,baie - Coefficient de transmission thermique (W/(m².K))
     */
    public function u(): ?float
    {
        return $this->ujn();
    }

    /**
     * Ujn - Coefficient de transmission thermique avec les protections solaires (W/(m².K))
     */
    public function ujn(): ?float
    {
        if ($this->input->fermeture()->ujn_saisi) {
            return $this->input->fermeture()->ujn_saisi;
        }
        return ($uw = $this->uw()) ? $this->table_ujn_collection()->ujn(uw: $uw) : null;
    }

    /**
     * ΔR - Résistance additionnelle due à la présence de fermeture (m2.K/W)
     */
    public function deltar(): ?float
    {
        return $this->table_deltar()?->deltar();
    }

    /**
     * Uw - Coefficient de transmission thermique (vitrage + menuiserie) (W/(m².K))
     */
    public function uw(): ?float
    {
        return $this->input->double_fenetre()
            ? 1 / (1 / $this->uw1() + 1 / $this->uw2() + 0.07)
            : $this->uw1();
    }

    /**
     * Uw1 - Coefficient de transmission thermique (vitrage + menuiserie) (W/(m².K))
     */
    public function uw1(): ?float
    {
        if ($this->input->menuiserie()->uw_saisi) {
            return $this->input->menuiserie()->uw_saisi;
        }
        return ($ug = $this->ug()) ? $this->table_uw_collection()->uw(ug: $ug) : null;
    }

    /**
     * Uw2 - Coefficient de transmission thermique de la double fenêtre (vitrage + menuiserie) (W/(m².K))
     */
    public function uw2(): ?float
    {
        return $this->deperdition_double_fenetre()?->uw() ?: 1;
    }

    /**
     * Ug - Coefficient de transmission thermique du vitrage (W/(m².K))
     */
    public function ug(): ?float
    {
        return $this->input->vitrage()->ug_saisi ?? $this->table_ug_collection()?->ug(
            epaisseur_lame: $this->input->vitrage()->epaisseur_lame ?? 0
        );
    }

    /**
     * b,paroi - Coefficient de réduction thermique
     */
    public function b(): float
    {
        if (null === $this->input->local_non_chauffe()) {
            return 1;
        }
        return $this
            ->engine
            ->context()
            ->lnc_engine()
            ->reduction_deperdition()
            ->b(lnc: $this->input->local_non_chauffe()) ?? 1;
    }

    /**
     * Surface déperditive (m²)
     */
    public function sdep(): float
    {
        return $this->input->surface_deperditive();
    }

    /**
     * Indicateur de performance de l'élément
     */
    public function qualite_isolation(): ?QualiteComposant
    {
        return ($u = $this->u()) ? QualiteComposant::from_ubaie($u) : null;
    }

    public function deperdition_double_fenetre(): ?DeperditionDoubleFenetre
    {
        return $this->deperdition_double_fenetre;
    }

    public function table_ug_collection(): UgCollection
    {
        return $this->table_ug_collection;
    }

    public function table_uw_collection(): UwCollection
    {
        return $this->table_uw_collection;
    }

    public function table_deltar(): ?Deltar
    {
        return $this->table_deltar;
    }

    public function table_ujn_collection(): UjnCollection
    {
        return $this->table_ujn_collection;
    }

    public function input(): Baie
    {
        return $this->input;
    }

    public function __invoke(Baie $input, BaieEngine $engine): self
    {
        $this->input = $input;
        $this->engine = $engine;
        $this->deperdition_double_fenetre = $input->double_fenetre() ? ($this->deperdition_double_fenetre_engine)($input->double_fenetre()) : null;

        $this->table_ug_collection = $this->table_ug_repository->search(
            type_vitrage: $input->vitrage()->type_vitrage,
            type_gaz_lame: $input->vitrage()->type_gaz_lame,
            inclinaison: $input->vitrage()->inclinaison_vitrage,
            vitrage_vir: $input->vitrage()->vitrage_vir,
        );

        $this->table_uw_collection = $this->table_uw_repository->search(
            type_baie: $input->caracteristique()->type_baie,
            materiaux_menuiserie: $input->menuiserie()->type_materiaux,
        );

        $this->table_deltar = $this->table_deltar_repository->find(
            type_fermeture: $input->fermeture()->type_fermeture,
        );

        $this->table_ujn_collection = $this->table_deltar
            ? $this->table_ujn_repository->search(deltar: $this->table_deltar())
            : new UjnCollection;

        return $this;
    }
}
