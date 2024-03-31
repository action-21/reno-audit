<?php

namespace App\Command\Simulation\Ventilation;

use App\Domain\Moteur3CL\Ventilation\ConsommationVentilation;

final class ConsommationVentilationHandler
{
    use ConsommationVentilation;

    public function __construct(private ConsommationVentilation $service,)
    {
    }

    public function __invoke(ConsommationVentilationCommand $input): ConsommationVentilation
    {
        return ($this->service)($input);
    }
}
