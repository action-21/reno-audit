<?php

namespace App\Domain\Baie\Engine;

use App\Domain\Baie\Table\{UgCollection, UgRepository, UwCollection, UwRepository};
use App\Domain\Baie\ValueObject\DoubleFenetre;

/**
 * @see §3.3
 */
final class DeperditionDoubleFenetre
{
    private DoubleFenetre $input;
    private UgCollection $table_ug_collection;
    private UwCollection $table_uw_collection;

    public function __construct(
        private UgRepository $table_ug_repository,
        private UwRepository $table_uw_repository,
    ) {
    }

    /**
     * Ug - Coefficient de transmission thermique du vitrage (W/(m².K))
     */
    public function ug(): ?float
    {
        return $this->input->vitrage->ug_saisi ?: $this->table_ug_collection()->ug(
            epaisseur_lame: $this->input->vitrage->epaisseur_lame ?? 0
        );
    }

    /**
     * Uw - Coefficient de transmission thermique de la double fenêtre (vitrage + menuiserie) (W/(m².K))
     */
    public function uw(): ?float
    {
        if ($this->input->menuiserie->uw_saisi) {
            return $this->input->menuiserie->uw_saisi;
        }
        return ($ug = $this->ug()) ? $this->table_uw_collection()->uw(ug: $ug) : null;
    }

    public function table_ug_collection(): UgCollection
    {
        return $this->table_ug_collection;
    }

    public function table_uw_collection(): UwCollection
    {
        return $this->table_uw_collection;
    }

    public function __invoke(DoubleFenetre $input): self
    {
        $this->input = $input;

        $this->table_ug_collection = $this->table_ug_repository->search(
            type_vitrage: $input->vitrage->type_vitrage,
            type_gaz_lame: $input->vitrage->type_gaz_lame,
            inclinaison: $input->vitrage->inclinaison_vitrage,
            vitrage_vir: $input->vitrage->vitrage_vir,
        );

        $this->table_uw_collection = $this->table_uw_repository->search(
            type_baie: $input->type_baie,
            materiaux_menuiserie: $input->menuiserie->type_materiaux,
        );

        return $this;
    }
}
