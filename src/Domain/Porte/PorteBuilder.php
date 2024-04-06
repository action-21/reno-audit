<?php

namespace App\Domain\Porte;

use App\Domain\Enveloppe\Enveloppe;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\Paroi\Enum\Mitoyennete;
use App\Domain\Porte\ValueObject\{Caracteristique, Performance};

final class PorteBuilder
{
    private ?Porte $entity = null;

    /**
     * Initialise une porte
     */
    public function create(
        Enveloppe $enveloppe,
        string $description,
        Performance $performance,
        Caracteristique $caracteristique,
    ): void {
        $this->entity = new Porte(
            reference: Uuid::create(),
            enveloppe: $enveloppe,
            description: $description,
            performance: $performance,
            caracteristique: $caracteristique,
        );
    }

    /**
     * Construit une porte rattachée à une paroi opaque
     */
    public function build_with_paroi_opaque(\Stringable $reference_paroi_opaque): Porte
    {
        return $this->entity->set_paroi_opaque(reference_paroi_opaque: $reference_paroi_opaque);
    }

    /**
     * Construit une porte donnant sur un local non chauffé
     */
    public function build_with_local_non_chauffe(
        Mitoyennete $mitoyennete,
        ?\Stringable $reference_local_non_chauffe = null,
    ): Porte {
        return $this->entity->set_mitoyennete(
            mitoyennete: $mitoyennete,
            reference_local_non_chauffe: $reference_local_non_chauffe,
        );
    }

    /**
     * Construit une porte par défaut
     */
    public function build(): Porte
    {
        return $this->entity;
    }
}
