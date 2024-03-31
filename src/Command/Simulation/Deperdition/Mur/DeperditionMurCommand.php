<?php

namespace App\Command\Simulation\Deperdition\Mur;

use App\Domain\Audit\Mur\Mur;
use App\Domain\Common\Enum\Isolation\{PeriodeIsolation, TypeIsolation};
use App\Domain\Common\Enum\Paroi\TypeAdjacence;
use App\Domain\Common\Enum\Mur\{MateriauxStructure, TypeDoublage};
use App\Domain\Common\Enum\Situation\{PeriodeConstruction, ZoneClimatique};

final class DeperditionMurCommand
{
    public function __construct(
        public readonly float $surface_pleine,
        public readonly ?float $umur_saisi,
        public readonly ?float $umur0_saisi,
        public readonly float $epaisseur_structure,
        public readonly ?float $resistance_isolation,
        public readonly ?float $epaisseur_isolation,
        public readonly bool $effet_joule,
        public readonly bool $enduit_isolant_paroi_ancienne,
        public readonly MateriauxStructure $materiaux_structure,
        public readonly TypeDoublage $type_doublage,
        public readonly TypeIsolation $type_isolation,
        public readonly PeriodeConstruction|PeriodeIsolation $periode_construction_isolation,
        public readonly ?float $surface_aiu,
        public readonly ?float $surface_aue,
        public readonly ?bool $isolation_aiu,
        public readonly ?bool $isolation_aue,
        public readonly bool $isolation,
        public readonly bool $adjacence_ets,
        public readonly array $orientation_ets_collection,
        public readonly ZoneClimatique $zone_climatique,
        public readonly TypeAdjacence $type_adjacence,
    ) {
    }

    public static function from(Mur $entity,): self
    {
        return new self(
            surface_pleine: $entity->surface_pleine(),
            umur_saisi: $entity->umur_saisi(),
            umur0_saisi: $entity->umur0_saisi(),
            epaisseur_structure: $entity->epaisseur_structure(),
            resistance_isolation: $entity->resistance_isolation(),
            epaisseur_isolation: $entity->epaisseur_isolation(),
            effet_joule: $entity->effet_joule(),
            enduit_isolant_paroi_ancienne: $entity->enduit_isolant_paroi_ancienne(),
            materiaux_structure: $entity->materiaux_structure(),
            type_doublage: $entity->type_doublage(),
            periode_construction_isolation: $entity->periode_construction_isolation(),
            type_isolation: $entity->type_isolation(),
            surface_aiu: $entity->lnc()?->surface_aiu(),
            surface_aue: $entity->lnc()?->surface_aue(),
            isolation_aiu: $entity->lnc()?->isolation_aiu(),
            isolation_aue: $entity->lnc()?->isolation_aue(),
            isolation: $entity->isolation(),
            adjacence_ets: $entity->adjacence_ets(),
            orientation_ets_collection: $entity->lnc()->ets_baie_collection()->orientations() ?? [],
            zone_climatique: $entity->enveloppe()->audit()->zone_climatique(),
            type_adjacence: $entity->type_adjacence(),
        );
    }
}
