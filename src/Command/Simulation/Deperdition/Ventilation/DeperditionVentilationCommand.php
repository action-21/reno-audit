<?php

namespace App\Command\Simulation\Deperdition\Ventilation;

use App\Domain\Audit\Ventilation\Ventilation;
use App\Domain\Common\Enum\Situation\{PeriodeConstruction, TypeBatiment};
use App\Domain\Common\Enum\Ventilation\{ConfigurationExposition, TypeVentilation};

final class DeperditionVentilationCommand
{
    public function __construct(
        public readonly float $surface_habitable,
        public readonly float $hsp,
        public readonly float $sdep,
        public readonly float $volume,
        public readonly bool $presence_joint,
        public readonly bool $isolation_murs_plafonds,
        public readonly ?float $q4pa_conv_saisi,
        public readonly TypeBatiment $type_batiment,
        public readonly PeriodeConstruction $periode_construction,
        public readonly TypeVentilation $type_ventilation,
        public readonly ConfigurationExposition $exposition,
    ) {
    }

    /**
     * TODO : Vérifier si surface_habitable = surface_ventile
     */
    public static function from(Ventilation $entity): self
    {
        return new self(
            surface_habitable: $entity->surface_ventile(),
            hsp: $entity->logement()->hsp(),
            sdep: $entity->surface_deperditive(),
            volume: $entity->volume_ventile(),
            presence_joint: $entity->presence_joint(),
            isolation_murs_plafonds: $entity->isolation_murs_plafonds(),
            q4pa_conv_saisi: $entity->q4pa_conv_saisi(),
            type_batiment: $entity->type_batiment(),
            periode_construction: $entity->periode_construction(),
            type_ventilation: $entity->type_ventilation(),
            exposition: $entity->exposition(),
        );
    }
}
