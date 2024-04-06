<?php

namespace App\Domain\Baie\Engine;

use App\Domain\Baie\Table\{Sw, SwRepository};
use App\Domain\Baie\ValueObject\DoubleFenetre;

/**
 * @see §6.2
 */
final class SseDoubleFenetre
{
    private DoubleFenetre $input;
    private ?Sw $table_sw;

    public function __construct(private SwRepository $table_sw_repository)
    {
    }

    /**
     * Sw - Proportion d'énergie solaire incidente qui pénètre dans le logement par la double fenêtre
     */
    public function sw(): float
    {
        return $this->input->performance->sw_saisi ?? ($this->table_sw()?->sw() ?? 1);
    }

    /**
     * Valeur forfaitaire de la table sw
     */
    public function table_sw(): ?Sw
    {
        return $this->table_sw;
    }

    public function __invoke(DoubleFenetre $input): self
    {
        $this->input = $input;

        $this->table_sw = $this->table_sw_repository->find(
            type_baie: $this->input->type_baie,
            materiaux_menuiserie: $this->input->menuiserie->type_materiaux,
            type_pose: $this->input->type_pose,
            type_vitrage: $this->input->vitrage->type_vitrage,
            vitrage_vir: $this->input->vitrage->vitrage_vir,
        );

        return $this;
    }
}
