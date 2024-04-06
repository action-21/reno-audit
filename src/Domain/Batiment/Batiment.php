<?php

namespace App\Domain\Batiment;

use App\Domain\Audit\Audit;
use App\Domain\Batiment\Entity\NiveauCollection;
use App\Domain\Batiment\ValueObject\{Adresse, Caracteristique};
use App\Domain\Common\Identifier\Uuid;
use App\Domain\Enveloppe\Enveloppe;
use App\Domain\Logement\LogementCollection;

final class Batiment
{
    private Enveloppe $enveloppe;

    public function __construct(
        private readonly \Stringable $reference,
        private readonly Audit $audit,
        private Adresse $adresse,
        private Caracteristique $caracteristique,
        private NiveauCollection $niveau_collection,
        private LogementCollection $logement_collection,
    ) {
    }

    public static function create(Audit $audit, Adresse $adresse, Caracteristique $caracteristique): self
    {
        $entity = new self(
            reference: Uuid::create(),
            audit: $audit,
            adresse: $adresse,
            caracteristique: $caracteristique,
            niveau_collection: new NiveauCollection,
            logement_collection: new LogementCollection,
        );

        $entity->enveloppe = Enveloppe::create($entity);

        return $entity;
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

    public function enveloppe(): Enveloppe
    {
        return $this->enveloppe;
    }

    public function adresse(): Adresse
    {
        return $this->adresse;
    }

    public function caracteristique(): Caracteristique
    {
        return $this->caracteristique;
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
}
