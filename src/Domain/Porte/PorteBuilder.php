<?php

namespace App\Domain\Porte;

use App\Domain\Batiment\Batiment;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\Paroi\Enum\Mitoyennete;
use App\Domain\Porte\ValueObject\{Caracteristique, Performance};

final class PorteBuilder
{
    private ?Porte $entity = null;

    public function create(
        Batiment $batiment,
        string $description,
        Performance $performance,
        Caracteristique $caracteristique,
    ): void {
        $this->entity = new Porte(
            reference: Uuid::create(),
            batiment: $batiment,
            description: $description,
            performance: $performance,
            caracteristique: $caracteristique,
        );
    }

    public function build_with_paroi_opaque(\Stringable $reference_paroi_opaque): Porte
    {
        return $this->entity->set_paroi_opaque(reference_paroi_opaque: $reference_paroi_opaque);
    }

    public function build_with_local_non_chauffe(
        Mitoyennete $mitoyennete,
        ?\Stringable $reference_local_non_chauffe = null,
    ): Porte {
        return $this->entity->set_mitoyennete(
            mitoyennete: $mitoyennete,
            reference_local_non_chauffe: $reference_local_non_chauffe,
        );
    }
}
