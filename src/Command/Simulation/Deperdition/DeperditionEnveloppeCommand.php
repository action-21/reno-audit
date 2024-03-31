<?php

namespace App\Command\Simulation\Deperdition;

use App\Command\Simulation\Deperdition\Baie\DeperditionBaieCommand;
use App\Command\Simulation\Deperdition\Mur\DeperditionMurCommand;
use App\Command\Simulation\Deperdition\PlancherBas\DeperditionPlancherBasCommand;
use App\Command\Simulation\Deperdition\PlancherHaut\DeperditionPlancherHautCommand;
use App\Command\Simulation\Deperdition\Porte\DeperditionPorteCommand;
use App\Command\Simulation\Deperdition\Ventilation\DeperditionVentilationCommand;
use App\Command\Simulation\Deperdition\PontThermique\DeperditionPontThermiqueCommand;

/**
 * @property DeperditionBaieCommand[] $baie_collection 
 * @property DeperditionMurCommand[] $mur_collection 
 * @property DeperditionPlancherBasCommand[] $plancher_haut_collection 
 * @property DeperditionPlancherHautCommand[] $plancher_bas_collection 
 * @property DeperditionPorteCommand[] $porte_collection 
 * @property DeperditionPontThermiqueCommand[] $pont_thermique_collection 
 */
final class DeperditionEnveloppeCommand
{
    public function __construct(
        public readonly array $baie_collection,
        public readonly array $mur_collection,
        public readonly array $plancher_haut_collection,
        public readonly array $plancher_bas_collection,
        public readonly array $porte_collection,
        public readonly array $pont_thermique_collection,
        public readonly ?DeperditionVentilationCommand $ventilation,
    ) {
    }
}
