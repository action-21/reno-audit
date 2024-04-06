<?php

namespace App\Domain\Enveloppe;

use App\Domain\Baie\BaieCollection;
use App\Domain\Batiment\Batiment;
use App\Domain\Lnc\LncCollection;
use App\Domain\MasqueLointain\MasqueLointainCollection;
use App\Domain\MasqueProche\MasqueProcheCollection;
use App\Domain\Mur\MurCollection;
use App\Domain\Paroi\ParoiCollection;
use App\Domain\PlancherBas\PlancherBasCollection;
use App\Domain\PlancherHaut\PlancherHautCollection;
use App\Domain\PlancherIntermediaire\PlancherIntermediaireCollection;
use App\Domain\PontThermique\PontThermiqueCollection;
use App\Domain\Porte\PorteCollection;
use App\Domain\Refend\RefendCollection;

/**
 * Enveloppe d'un bâtiment
 */
final class Enveloppe
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Batiment $batiment,
        private MasqueProcheCollection $masque_proche_collection,
        private MasqueLointainCollection $masque_lointain_collection,
        private LncCollection $lnc_collection,
        private BaieCollection $baie_collection,
        private MurCollection $mur_collection,
        private PlancherBasCollection $plancher_bas_collection,
        private PlancherIntermediaireCollection $plancher_intermediaire_collection,
        private PlancherHautCollection $plancher_haut_collection,
        private PorteCollection $porte_collection,
        private PontThermiqueCollection $pont_thermique_collection,
        private RefendCollection $refend_collection,
    ) {
    }

    /**
     * Créé une enveloppe
     */
    public static function create(Batiment $batiment): self
    {
        return new self(
            reference: $batiment->reference(),
            batiment: $batiment,
            masque_proche_collection: new MasqueProcheCollection,
            masque_lointain_collection: new MasqueLointainCollection,
            lnc_collection: new LncCollection,
            baie_collection: new BaieCollection,
            mur_collection: new MurCollection,
            plancher_bas_collection: new PlancherBasCollection,
            plancher_intermediaire_collection: new PlancherIntermediaireCollection,
            plancher_haut_collection: new PlancherHautCollection,
            porte_collection: new PorteCollection,
            pont_thermique_collection: new PontThermiqueCollection,
            refend_collection: new RefendCollection,
        );
    }

    public function reference(): \Stringable
    {
        return $this->reference;
    }

    public function batiment(): Batiment
    {
        return $this->batiment;
    }

    public function masque_proche_collection(): MasqueProcheCollection
    {
        return $this->masque_proche_collection;
    }

    public function masque_lointain_collection(): MasqueLointainCollection
    {
        return $this->masque_lointain_collection;
    }

    public function lnc_collection(): LncCollection
    {
        return $this->lnc_collection;
    }

    public function baie_collection(): BaieCollection
    {
        return $this->baie_collection;
    }

    public function mur_collection(): MurCollection
    {
        return $this->mur_collection;
    }

    public function plancher_bas_collection(): PlancherBasCollection
    {
        return $this->plancher_bas_collection;
    }

    public function plancher_intermediaire_collection(): PlancherIntermediaireCollection
    {
        return $this->plancher_intermediaire_collection;
    }

    public function plancher_haut_collection(): PlancherHautCollection
    {
        return $this->plancher_haut_collection;
    }

    public function porte_collection(): PorteCollection
    {
        return $this->porte_collection;
    }

    public function pont_thermique_collection(): PontThermiqueCollection
    {
        return $this->pont_thermique_collection;
    }

    public function refend_collection(): RefendCollection
    {
        return $this->refend_collection;
    }

    public function paroi_collection(): ParoiCollection
    {
        return new ParoiCollection([
            ...$this->baie_collection->to_array(),
            ...$this->mur_collection->to_array(),
            ...$this->plancher_bas_collection->to_array(),
            ...$this->plancher_haut_collection->to_array(),
            ...$this->porte_collection->to_array(),
        ]);
    }
}
