<?php

namespace App\Domain\Batiment;

use App\Domain\Audit\Audit;
use App\Domain\Baie\BaieCollection;
use App\Domain\Batiment\Entity\NiveauCollection;
use App\Domain\Batiment\Enum\TypeBatiment;
use App\Domain\Batiment\ValueObject\{Adresse, Caracteristique};
use App\Domain\Common\Identifier\Uuid;
use App\Domain\Logement\LogementCollection;
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

final class Batiment
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Audit $audit,
        private Adresse $adresse,
        private Caracteristique $caracteristique,
        private NiveauCollection $niveau_collection,
        private LogementCollection $logement_collection,
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

    public static function create(
        Audit $audit,
        Adresse $adresse,
        Caracteristique $caracteristique,
    ): self {
        return new self(
            reference: Uuid::create(),
            audit: $audit,
            adresse: $adresse,
            caracteristique: $caracteristique,
            niveau_collection: new NiveauCollection,
            logement_collection: new LogementCollection,
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

    public function update(Adresse $adresse, Caracteristique $caracteristique,): self
    {
        $this->adresse = $adresse;
        $this->caracteristique = $caracteristique;

        return $this;
    }

    public function reference(): \Stringable
    {
        return $this->reference;
    }

    public function audit(): Audit
    {
        return $this->audit;
    }

    public function adresse(): Adresse
    {
        return $this->adresse;
    }

    public function caracteristique(): Caracteristique
    {
        return $this->caracteristique;
    }

    public function type_batiment(): TypeBatiment
    {
        return $this->audit->methode_application()->type_batiment();
    }

    /**
     * TODO
     */
    public function parois_anciennes_lourdes(): bool
    {
        throw new \Exception;
    }

    /**
     * TODO
     */
    public function effet_joule(): bool
    {
        throw new \Exception;
    }

    public function niveau_collection(): NiveauCollection
    {
        return $this->niveau_collection;
    }

    public function logement_collection(): LogementCollection
    {
        return $this->logement_collection;
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
