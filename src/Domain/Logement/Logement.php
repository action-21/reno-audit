<?php

namespace App\Domain\Logement;

use App\Domain\Batiment\Batiment;
use App\Domain\Batiment\Entity\Niveau;
use App\Domain\Climatisation\ClimatisationCollection;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\Ventilation\Ventilation;
use App\Domain\Logement\Entity\NiveauCollection;

final class Logement
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Batiment $batiment,
        private Niveau $niveau,
        private NiveauCollection $niveau_collection,
        private ClimatisationCollection $climatisation_collection,
        private ?Ventilation $ventilation,
    ) {
    }

    public static function create(Batiment $batiment, \Stringable $reference_niveau): self
    {
        if (null === $niveau = $batiment->niveau_collection()->find($reference_niveau)) {
            throw new \InvalidArgumentException("Niveau $reference_niveau introuvable");
        }
        return (new self(
            reference: Uuid::create(),
            batiment: $batiment,
            niveau: $niveau,
            niveau_collection: new NiveauCollection,
            climatisation_collection: new ClimatisationCollection,
            ventilation: null,
        ));
    }

    public function reference(): \Stringable
    {
        return $this->reference;
    }

    public function batiment(): Batiment
    {
        return $this->batiment;
    }

    public function niveau(): Niveau
    {
        return $this->niveau;
    }

    public function niveau_collection(): NiveauCollection
    {
        return $this->niveau_collection;
    }

    public function ventilation(): ?Ventilation
    {
        return $this->ventilation;
    }

    public function climatisation_collection(): ClimatisationCollection
    {
        return $this->climatisation_collection;
    }

    public function effet_joule(): bool
    {
        return false;
    }

    public function ratio(): float
    {
        return $this->batiment()->immeuble()?->surface_habitable()
            ? $this->surface_habitable() / $this->batiment()->immeuble()?->surface_habitable()
            : 1;
    }

    /*

    public function classe_inertie(): ?ClasseInertie
    {
        return ClasseInertie::tryFromCollection($this->niveau_collection->classe_inertie_collection());
    }*/
}
