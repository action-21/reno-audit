<?php

namespace App\Command\Simulation\Apport\SurfaceSudEquivalente;

use App\Domain\Common\Enum\Baie\TypeBaie;
use App\Domain\Common\Enum\Menuiserie\{MateriauxMenuiserie, TypePose};
use App\Domain\Common\Enum\Vitrage\{InclinaisonVitrage, TypeGazLame, TypeVitrage};
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\SseDoubleFenetre;
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\Table\SwRepository;

final class SseDoubleFenetreHandler
{
    use SseDoubleFenetre;

    private SseDoubleFenetreCommand $command;

    public function __construct(
        private SwRepository $table_sw_repository,
    ) {
    }

    /** @inheritdoc */
    public function sw_saisi(): ?float
    {
        return $this->command->sw_saisi;
    }


    /** @inheritdoc */
    public function vitrage_vir(): bool
    {
        return $this->command->vitrage_vir;
    }

    /** @inheritdoc */
    public function type_baie(): TypeBaie
    {
        return $this->command->type_baie;
    }

    /** @inheritdoc */
    public function type_pose(): TypePose
    {
        return $this->command->type_pose;
    }

    /** @inheritdoc */
    public function type_materiaux_menuiserie(): MateriauxMenuiserie
    {
        return $this->command->type_materiaux_menuiserie;
    }

    /** @inheritdoc */
    public function type_vitrage(): TypeVitrage
    {
        return $this->command->type_vitrage;
    }

    /** @inheritdoc */
    public function type_gaz_lame(): TypeGazLame
    {
        return $this->command->type_gaz_lame;
    }

    /** @inheritdoc */
    public function inclinaison_vitrage(): InclinaisonVitrage
    {
        return $this->command->inclinaison_vitrage;
    }

    public function __invoke(SseDoubleFenetreCommand $command): self
    {
        $this->command = $command;

        return $this;
    }
}
