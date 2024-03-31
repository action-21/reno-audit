<?php

namespace App\Command\Simulation\Deperdition;

use App\Command\Simulation\Deperdition\Baie\{DeperditionBaieCommand, DeperditionBaieHandler};
use App\Command\Simulation\Deperdition\Mur\{DeperditionMurCommand, DeperditionMurHandler};
use App\Command\Simulation\Deperdition\PlancherBas\{DeperditionPlancherBasCommand, DeperditionPlancherBasHandler};
use App\Command\Simulation\Deperdition\PlancherHaut\{DeperditionPlancherHautCommand, DeperditionPlancherHautHandler};
use App\Command\Simulation\Deperdition\PontThermique\{DeperditionPontThermiqueCommand, DeperditionPontThermiqueHandler};
use App\Command\Simulation\Deperdition\Porte\{DeperditionPorteCommand, DeperditionPorteHandler};
use App\Command\Simulation\Deperdition\Ventilation\DeperditionVentilationHandler;
use App\Domain\Moteur3CL\Deperdition\DeperditionEnveloppe;
use App\Domain\Moteur3CL\Deperdition\Baie\{DeperditionBaie, DeperditionBaieCollection};
use App\Domain\Moteur3CL\Deperdition\Mur\{DeperditionMur, DeperditionMurCollection};
use App\Domain\Moteur3CL\Deperdition\PlancherBas\{DeperditionPlancherBas, DeperditionPlancherBasCollection};
use App\Domain\Moteur3CL\Deperdition\PlancherHaut\{DeperditionPlancherHaut, DeperditionPlancherHautCollection};
use App\Domain\Moteur3CL\Deperdition\PontThermique\{DeperditionPontThermique, DeperditionPontThermiqueCollection};
use App\Domain\Moteur3CL\Deperdition\Porte\{DeperditionPorte, DeperditionPorteCollection};
use App\Domain\Moteur3CL\Deperdition\Ventilation\DeperditionVentilation;

final class DeperditionEnveloppeHandler
{
    use DeperditionEnveloppe;

    private DeperditionEnveloppeCommand $command;

    public function __construct(
        private DeperditionBaieHandler $deperdition_baie_handler,
        private DeperditionMurHandler $deperdition_mur_handler,
        private DeperditionPlancherBasHandler $deperdition_plancher_bas_handler,
        private DeperditionPlancherHautHandler $deperdition_plancher_haut_handler,
        private DeperditionPorteHandler $deperdition_porte_handler,
        private DeperditionVentilationHandler $deperdition_ventilation_handler,
        private DeperditionPontThermiqueHandler $deperdition_pont_thermique_handler,
    ) {
    }

    /** @inheritdoc */
    public function baie_collection(): DeperditionBaieCollection
    {
        return $this->has('baie_collection')
            ? $this->get('baie_collection')
            : $this->set('baie_collection', new DeperditionBaieCollection(\array_map(
                fn (DeperditionBaieCommand $item): DeperditionBaie => ($this->deperdition_baie_handler)($item),
                $this->command->baie_collection,
            )));
    }

    /** @inheritdoc */
    public function mur_collection(): DeperditionMurCollection
    {
        return $this->has('mur_collection')
            ? $this->get('mur_collection')
            : $this->set('mur_collection', new DeperditionMurCollection(\array_map(
                fn (DeperditionMurCommand $item): DeperditionMur => ($this->deperdition_mur_handler)($item),
                $this->command->mur_collection,
            )));
    }

    /** @inheritdoc */
    public function plancher_bas_collection(): DeperditionPlancherBasCollection
    {
        return $this->has('plancher_bas_collection')
            ? $this->get('plancher_bas_collection')
            : $this->set('plancher_bas_collection', new DeperditionPlancherBasCollection(\array_map(
                fn (DeperditionPlancherBasCommand $item): DeperditionPlancherBas => ($this->deperdition_plancher_bas_handler)($item),
                $this->command->plancher_bas_collection,
            )));
    }

    /** @inheritdoc */
    public function plancher_haut_collection(): DeperditionPlancherBasCollection
    {
        return $this->has('plancher_haut_collection')
            ? $this->get('plancher_haut_collection')
            : $this->set('plancher_haut_collection', new DeperditionPlancherHautCollection(\array_map(
                fn (DeperditionPlancherHautCommand $item): DeperditionPlancherHaut => ($this->deperdition_plancher_haut_handler)($item),
                $this->command->plancher_haut_collection,
            )));
    }

    /** @inheritdoc */
    public function porte_collection(): DeperditionPorteCollection
    {
        return $this->has('porte_collection')
            ? $this->get('porte_collection')
            : $this->set('porte_collection', new DeperditionPorteCollection(\array_map(
                fn (DeperditionPorteCommand $item): DeperditionPorte => ($this->deperdition_porte_handler)($item),
                $this->command->porte_collection,
            )));
    }

    /** @inheritdoc */
    public function ventilation(): ?DeperditionVentilation
    {
        if (null === $this->command->ventilation) {
            return null;
        }
        return $this->has('ventilation')
            ? $this->get('ventilation')
            : $this->set('ventilation', ($this->deperdition_ventilation_handler)($this->command->ventilation));
    }

    /** @inheritdoc */
    public function pont_thermique_collection(): DeperditionPontThermiqueCollection
    {
        return $this->has('pont_thermique_collection')
            ? $this->get('pont_thermique_collection')
            : $this->set('pont_thermique_collection', new DeperditionPontThermiqueCollection(\array_map(
                fn (DeperditionPontThermiqueCommand $item): DeperditionPontThermique => ($this->deperdition_pont_thermique_handler)($item),
                $this->command->pont_thermique_collection,
            )));
    }
}
