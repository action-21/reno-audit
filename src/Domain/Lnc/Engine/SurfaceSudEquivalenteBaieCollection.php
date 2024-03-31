<?php

namespace App\Domain\Lnc\Engine;

use App\Domain\Common\Enum\Mois;
use App\Domain\Lnc\Entity\{Baie, BaieCollection};

/**
 * @see §6.3 Traitement des espaces tampons solarisés
 */
final class SurfaceSudEquivalenteBaieCollection
{
    /**
     * @var SurfaceSudEquivalenteBaie[]
     */
    private array $collection = [];

    public function __construct(
        private SurfaceSudEquivalenteBaie $surface_sud_equivalente_baie,
    ) {
    }

    /**
     * Somme des surfaces des baies constitutives de la véranda
     */
    public function surface(): float
    {
        return \array_reduce(
            $this->collection,
            fn (SurfaceSudEquivalenteBaie $item, float $surface): float => $surface + $item->surface(),
        );
    }

    /**
     * Surface sud équivalente des apports dans la véranda pour le mois j
     */
    public function sst_j(Mois $mois): float
    {
        return \array_reduce(
            $this->collection,
            fn (SurfaceSudEquivalenteBaie $item, float $sst): float => $sst + $item->sst_j($mois),
        );
    }

    /**
     * t,k - Coefficient de transparence de la véranda
     * 
     * Dans le cas où les vitrages séparant l’espace tampon solarisé de l’extérieur sont hétérogènes, le coefficient T
     * est celui du vitrage majoritaire. Dans le cas où aucun vitrage n’est majoritaire, le coefficient T est proratisé
     * à la surface.
     * 
     * TODO: inclure la cas où un vitrage est majoritaire
     */
    public function t(): float
    {
        return ($surface = $this->surface()) > 0 ? \array_reduce(
            $this->collection,
            fn (SurfaceSudEquivalenteBaie $item, float $t): float => $t + $item->t() * ($item->surface() / $surface),
        ) : 0;
    }

    /**
     * @return SurfaceSudEquivalenteBaie[]
     */
    public function to_array(): array
    {
        return $this->collection;
    }

    public function __invoke(BaieCollection $input): self
    {
        $this->collection = \array_map(
            fn (Baie $item): SurfaceSudEquivalenteBaie => ($this->surface_sud_equivalente_baie)($item),
            $input->to_array(),
        );

        return $this;
    }
}
