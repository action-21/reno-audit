<?php

namespace App\Command\Simulation\Deperdition\PlancherHaut;

use App\Domain\Audit\PlancherHaut\PlancherHaut;
use App\Domain\Common\Enum\Isolation\{PeriodeIsolation, TypeIsolation};
use App\Domain\Common\Enum\Paroi\TypeAdjacence;
use App\Domain\Common\Enum\PlancherHaut\{TypePlancherHaut, TypeToiture};
use App\Domain\Common\Enum\Situation\{PeriodeConstruction, ZoneClimatique};

final class DeperditionPlancherHautCommand
{
    public function __construct(
        public readonly float $surface_pleine,
        public readonly ?float $uph_saisi,
        public readonly ?float $uph0_saisi,
        public readonly ?float $resistance_isolation,
        public readonly ?float $epaisseur_isolation,
        public readonly bool $effet_joule,
        public readonly TypePlancherHaut $type_plancher_haut,
        public readonly TypeToiture $type_toiture,
        public readonly TypeIsolation $type_isolation,
        public readonly PeriodeConstruction $periode_construction,
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

    public static function from(PlancherHaut $entity,): self
    {
        return new self(
            surface_pleine: $entity->surface_pleine(),
            uph_saisi: $entity->uph_saisi(),
            uph0_saisi: $entity->uph0_saisi(),
            resistance_isolation: $entity->resistance_isolation(),
            epaisseur_isolation: $entity->epaisseur_isolation(),
            effet_joule: $entity->effet_joule(),
            type_plancher_haut: $entity->type_plancher_haut(),
            type_toiture: $entity->type_toiture(),
            periode_construction: $entity->periode_construction(),
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
