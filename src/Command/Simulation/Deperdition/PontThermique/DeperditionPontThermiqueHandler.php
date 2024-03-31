<?php

namespace App\Command\Simulation\Deperdition\PontThermique;

use App\Domain\Common\Enum\Isolation\TypeIsolation;
use App\Domain\Common\Enum\Menuiserie\TypePose;
use App\Domain\Common\Enum\PontThermique\TypeLiaison;
use App\Domain\Moteur3CL\Deperdition\PontThermique\DeperditionPontThermique;
use App\Domain\Moteur3CL\Deperdition\PontThermique\Table\KptRepository;

final class DeperditionPontThermiqueHandler
{
    use DeperditionPontThermique;

    private DeperditionPontThermiqueCommand $command;

    public function __construct(
        private KptRepository $table_k_repository,
    ) {
    }

    /** @inheritdoc */
    public function longueur(): float
    {
        return $this->command->longueur;
    }

    /** @inheritdoc */
    public function kpt_saisi(): ?float
    {
        return $this->command->k_saisi;
    }

    /** @inheritdoc */
    public function pont_thermique_partiel(): ?bool
    {
        return $this->command->pont_thermique_partiel;
    }

    /** @inheritdoc */
    public function largeur_dormant(): ?float
    {
        return $this->command->largeur_dormant;
    }

    /** @inheritdoc */
    public function presence_retour_isolation(): ?bool
    {
        return $this->command->presence_retour_isolation;
    }

    /** @inheritdoc */
    public function type_liaison(): TypeLiaison
    {
        return $this->command->type_liaison;
    }

    /** @inheritdoc */
    public function type_isolation_mur(): ?TypeIsolation
    {
        return $this->command->type_isolation_mur;
    }

    /** @inheritdoc */
    public function type_isolation_plancher(): ?TypeIsolation
    {
        return $this->command->type_isolation_plancher;
    }

    /** @inheritdoc */
    public function type_pose_ouverture(): ?TypePose
    {
        return $this->command->type_pose_ouverture;
    }

    public function __invoke(DeperditionPontThermiqueCommand $command): self
    {
        $this->command = $command;

        return $this;
    }
}
