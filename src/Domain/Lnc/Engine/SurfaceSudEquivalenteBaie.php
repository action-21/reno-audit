<?php

namespace App\Domain\Lnc\Engine;

use App\Domain\Common\Enum\Mois;
use App\Domain\Lnc\Entity\Baie;
use App\Domain\Lnc\Table\{C1Collection, C1Repository, CoefficientTransparence, CoefficientTransparenceRepository};

/**
 * @see §6.3 Traitement des espaces tampons solarisés
 */
final class SurfaceSudEquivalenteBaie
{
    private Baie $input;
    private ?C1Collection $table_c1_collection = null;
    private ?CoefficientTransparence $table_t = null;

    public function __construct(
        private C1Repository $table_c1_repository,
        private CoefficientTransparenceRepository $table_t_repository,
    ) {
    }

    /**
     * Surface sud équivalente des apports dans la véranda par la baie k pour le mois j
     */
    public function sst_j(Mois $mois): float
    {
        return $this->input->surface() * (0.8 * $this->t() + 0.024) * $this->fe() * $this->c1_j($mois);
    }

    /**
     * Fe,k - Facteur d'ensoleillement qui traduit la réduction d'énergie solaire reçue par la baie k du fait des masques lointains
     */
    public function fe(): float
    {
        return 1;
    }

    /**
     * C1,k,j - Coefficient d'orientation et d'inclinaison pour le mois j
     */
    public function c1_j(Mois $mois): float
    {
        return $this->table_c1_collection()->c1($mois);
    }

    /**
     * t,k - Coefficient de transparence
     */
    public function t(): float
    {
        return $this->table_t()?->t() ?? 0;
    }

    /**
     * A,k - Surface de la baie (m²)
     */
    public function surface(): float
    {
        return $this->input->surface();
    }

    public function table_c1_collection(): C1Collection
    {
        return $this->table_c1_collection;
    }

    public function table_t(): ?CoefficientTransparence
    {
        return $this->table_t;
    }

    public function input(): Baie
    {
        return $this->input;
    }

    public function __invoke(Baie $input): self
    {
        $this->input = $input;

        $this->table_c1_collection = $this->table_c1_repository->search(
            zone_climatique: $this->input->local_non_chauffe()->enveloppe()->batiment()->adresse()->zone_climatique,
            orientation: $this->input->orientation(),
            inclinaison_vitrage: $this->input->inclinaison_vitrage(),
        );

        $this->table_t = $this->table_t_repository->find(
            meteriaux_menuiserie: $this->input->type_materiaux_menuiserie(),
            type_vitrage: $this->input->type_vitrage(),
            vitrage_vir: $this->input->vitrage_vir(),
        );

        return $this;
    }
}
