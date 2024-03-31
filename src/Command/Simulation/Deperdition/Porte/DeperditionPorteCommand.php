<?php

namespace App\Command\Simulation\Deperdition\Porte;

use App\Domain\Audit\Porte\{Porte, PorteTravaux};
use App\Domain\Common\Enum\Paroi\TypeAdjacence;
use App\Domain\Common\Enum\Porte\TypePorte;
use App\Domain\Common\Enum\Situation\ZoneClimatique;

final class DeperditionPorteCommand
{
    public function __construct(
        public readonly float $surface,
        public readonly ?float $uporte,
        public readonly TypePorte $type_porte,
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

    public static function from(Porte $porte, ?PorteTravaux $travaux = null): self
    {
        return new self(
            surface: $porte->surface(),
            uporte: $travaux?->uporte_saisi() ?? $porte->uporte_saisi(),
            type_porte: $travaux?->type_porte() ?? $porte->type_porte(),
            surface_aiu: $porte->lnc()?->surface_aiu(),
            surface_aue: $porte->lnc()?->surface_aue(),
            isolation_aiu: $porte->lnc()?->isolation_aiu(),
            isolation_aue: $porte->lnc()?->isolation_aue(),
            isolation: $porte->isolation(),
            adjacence_ets: $porte->adjacence_ets(),
            orientation_ets_collection: $porte->lnc()->ets_baie_collection()->orientations() ?? [],
            zone_climatique: $porte->enveloppe()->audit()->zone_climatique(),
            type_adjacence: $porte->type_adjacence(),
        );
    }
}
