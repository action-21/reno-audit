<?php

namespace App\Domain\Lnc\Engine;

use App\Domain\Common\Enum\Mois;
use App\Domain\Lnc\Lnc;

/**
 * @see §6.3 Traitement des espaces tampons solarisés
 */
final class SurfaceSudEquivalente
{
    private Lnc $input;

    public function __construct(
        private SurfaceSudEquivalenteBaieCollection $surface_sud_equivalente_baie_collection,
    ) {
    }

    public function sst_j(Mois $mois): float
    {
        return $this->surface_sud_equivalente_baie_collection->sst_j($mois);
    }

    public function surface_sud_equivalente_baie_collection(): SurfaceSudEquivalenteBaieCollection
    {
        return $this->surface_sud_equivalente_baie_collection;
    }

    public function input(): Lnc
    {
        return $this->input;
    }

    public function apply(Lnc $input): bool
    {
        return $input->ets();
    }

    public function __invoke(Lnc $input): self
    {
        $this->input = $input;
        $this->surface_sud_equivalente_baie_collection = ($this->surface_sud_equivalente_baie_collection)($input->baie_collection());

        return $this;
    }
}
