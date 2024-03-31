<?php

namespace App\Command\Simulation\Apport\SurfaceSudEquivalente;

use App\Domain\Common\Enum\Masque\{Orientation, SecteurMasque, TypeMasqueLointain};
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\SseMasqueLointain;
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\Table\{Fe2Repository, OmbRepository};

final class SseMasqueLointainHandler
{
    use SseMasqueLointain;

    private SseMasqueLointainCommand $command;

    public function __construct(
        private Fe2Repository $table_fe2_repository,
        private OmbRepository $table_omb_repository,
    ) {
    }

    /** @inheritdoc */
    public function hauteur_alpha(): float
    {
        return $this->command->hauteur_alpha;
    }

    /** @inheritdoc */
    public function orientation(): Orientation
    {
        return $this->command->orientation;
    }

    /** @inheritdoc */
    public function type_masque(): TypeMasqueLointain
    {
        return $this->command->type_masque;
    }

    /** @inheritdoc */
    public function secteur(): ?SecteurMasque
    {
        return $this->command->secteur;
    }

    public function __invoke(SseMasqueLointainCommand $command): self
    {
        $this->command = $command;

        return $this;
    }
}
