<?php

namespace App\Command\Simulation\Apport\SurfaceSudEquivalente;

use App\Domain\Common\Enum\Masque\{Orientation, TypeMasqueProche};
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\SseMasqueProche;
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\Table\Fe1Repository;

final class SseMasqueProcheHandler
{
    use SseMasqueProche;

    private SseMasqueProcheCommand $command;

    public function __construct(
        private Fe1Repository $table_fe1_repository,
    ) {
    }

    /** @inheritdoc */
    public function avancee(): float
    {
        return $this->command->avancee;
    }

    /** @inheritdoc */
    public function orientation(): Orientation
    {
        return $this->command->orientation;
    }

    /** @inheritdoc */
    public function type_masque(): TypeMasqueProche
    {
        return $this->command->type_masque;
    }

    public function __invoke(SseMasqueProcheCommand $command): self
    {
        $this->command = $command;

        return $this;
    }
}
