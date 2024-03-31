<?php

namespace App\Command\Simulation\Ventilation;

use App\Domain\Audit\Ventilation\Ventilation;
use App\Domain\Common\Enum\Situation\TypeBatiment;
use App\Domain\Common\Enum\Ventilation\TypeVentilation;

final class ConsommationVentilationCommand
{
    public function __construct(
        public readonly float $surface_habitable,
        public readonly ?float $q4pa_conv,
        public readonly TypeBatiment $type_batiment,
        public readonly TypeVentilation $type_ventilation,
    ) {
    }

    /**
     * TODO : Vérifier si surface_habitable = surface_ventile
     */
    public static function from(Ventilation $entity): self
    {
        return new self(
            surface_habitable: $entity->surface_ventile(),
            q4pa_conv: $entity->q4pa_conv_saisi(),
            type_batiment: $entity->type_batiment(),
            type_ventilation: $entity->type_ventilation(),
        );
    }
}
