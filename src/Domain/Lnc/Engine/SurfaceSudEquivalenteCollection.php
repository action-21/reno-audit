<?php

namespace App\Domain\Lnc\Engine;

use App\Domain\Common\Enum\Mois;
use App\Domain\Lnc\{Lnc, LncCollection};

/**
 * @see §6.3 Traitement des espaces tampons solarisés
 */
final class SurfaceSudEquivalenteCollection
{
    /**
     * @var SurfaceSudEquivalente[]
     */
    private array $collection = [];

    public function __construct(private SurfaceSudEquivalente $surface_sud_equivalente)
    {
    }

    /**
     * Surface sud équivalente des apports dans la véranda par la baie k pour le mois j
     */
    public function sst_j(Lnc $lnc, Mois $mois): ?float
    {
        return $this->find($lnc)->sst_j($mois);
    }

    /**
     * Retourne la surface sud équivalente correspondant au LNC
     */
    public function find(Lnc $lnc): ?SurfaceSudEquivalente
    {
        foreach ($this->collection as $item) {
            if ($item->input()->reference() == $lnc->reference()) {
                return $item;
            }
        }
        return null;
    }

    /**
     * @return SurfaceSudEquivalente[]
     */
    public function to_array(): array
    {
        return $this->collection;
    }

    public function __invoke(LncCollection $input): self
    {
        $this->collection = \array_map(
            fn (Lnc $item): SurfaceSudEquivalente => ($this->surface_sud_equivalente)($item),
            $input->filter(fn (Lnc $item): bool => $this->surface_sud_equivalente->apply($item))->to_array(),
        );

        return $this;
    }
}
