<?php

namespace App\Domain\Baie;

use App\Domain\Baie\ValueObject\{Caracteristique, DoubleFenetre, Fermeture, Menuiserie, Performance, Vitrage};
use App\Domain\Enveloppe\Enveloppe;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\MasqueProche\MasqueProcheCollection;
use App\Domain\Paroi\Enum\{Mitoyennete, Orientation, TypeAdjacence};

final class BaieBuilder
{
    private ?Baie $entity = null;

    /**
     * Initialise une baie
     */
    public function create(
        Enveloppe $enveloppe,
        string $description,
        Orientation $orientation,
        TypeAdjacence $type_adjacence,
        Caracteristique $caracteristique,
        Performance $performance,
        Vitrage $vitrage,
        Menuiserie $menuiserie,
        ?Fermeture $fermeture,
        ?DoubleFenetre $double_fenetre,
    ): void {
        $this->entity = new self(
            reference: Uuid::create(),
            enveloppe: $enveloppe,
            description: $description,
            orientation: $orientation,
            type_adjacence: $type_adjacence,
            caracteristique: $caracteristique,
            performance: $performance,
            vitrage: $vitrage,
            menuiserie: $menuiserie,
            fermeture: $fermeture,
            double_fenetre: $double_fenetre,
            masque_proche_collection: new MasqueProcheCollection(),
        );
    }

    /**
     * Construit une baie rattachée à une paroi opaque
     */
    public function build_with_paroi_opaque(\Stringable $reference_paroi_opaque): Baie
    {
        return $this->entity->set_paroi_opaque(reference_paroi_opaque: $reference_paroi_opaque);
    }

    /**
     * Construit une baie donnant sur un local non chauffé
     */
    public function build_with_local_non_chauffe(
        Mitoyennete $mitoyennete,
        ?\Stringable $reference_local_non_chauffe = null,
    ): Baie {
        return $this->entity->set_mitoyennete(
            mitoyennete: $mitoyennete,
            reference_local_non_chauffe: $reference_local_non_chauffe,
        );
    }

    /**
     * Construit une baie par défaut
     */
    public function build(): Baie
    {
        return $this->entity;
    }
}
