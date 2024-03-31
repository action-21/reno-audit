<?php

namespace App\Domain\PlancherHaut;

use App\Domain\Batiment\Batiment;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\Paroi\Enum\{Mitoyennete, Orientation};
use App\Domain\Paroi\ValueObject\{Performance, PerformanceIsolation};
use App\Domain\PlancherHaut\ValueObject\Caracteristique;

final class PlancherHautBuilder
{
    private ?PlancherHaut $entity = null;

    public function create(
        Batiment $batiment,
        string $description,
        Orientation $orientation,
        Caracteristique $caracteristique,
        Performance $performance,
        PerformanceIsolation $performance_isolation,
    ): void {
        $this->entity = new PlancherHaut(
            reference: Uuid::create(),
            batiment: $batiment,
            description: $description,
            caracteristique: $caracteristique,
            performance: $performance,
            performance_isolation: $performance_isolation,
            orientation: $orientation,
        );
    }

    public function build_combles_perdus(\Stringable $reference_local_non_chauffe): PlancherHaut
    {
        return $this->entity->set_combles_perdus(reference_local_non_chauffe: $reference_local_non_chauffe);
    }

    public function build_combles_habitables(Mitoyennete $mitoyennete, ?\Stringable $reference_local_non_chauffe): PlancherHaut
    {
        return $this->entity->set_combles_habitables(
            mitoyennete: $mitoyennete,
            reference_local_non_chauffe: $reference_local_non_chauffe
        );
    }

    public function build_toiture_terrasse(Mitoyennete $mitoyennete, ?\Stringable $reference_local_non_chauffe): PlancherHaut
    {
        return $this->entity->set_toiture_terrasse(
            mitoyennete: $mitoyennete,
            reference_local_non_chauffe: $reference_local_non_chauffe
        );
    }
}
