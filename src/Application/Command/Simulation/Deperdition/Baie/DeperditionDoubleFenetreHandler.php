<?php

namespace App\Command\Simulation\Deperdition\Baie;

use App\Domain\Common\Enum\Baie\TypeBaie;
use App\Domain\Common\Enum\Menuiserie\MateriauxMenuiserie;
use App\Domain\Common\Enum\Vitrage\{InclinaisonVitrage, TypeGazLame, TypeVitrage};
use App\Domain\Moteur3CL\Deperdition\Baie\DeperditionDoubleFenetre;
use App\Domain\Moteur3CL\Deperdition\Baie\Table\{UgRepository, UwRepository};

final class DeperditionDoubleFenetreHandler
{
    use DeperditionDoubleFenetre;

    private DeperditionDoubleFenetreCommand $command;

    public function __construct(
        private UgRepository $table_ug_repository,
        private UwRepository $table_uw_repository,
    ) {
    }

    /** @inheritdoc */
    public function ug_saisi(): ?float
    {
        return $this->command->ug_saisi;
    }

    /** @inheritdoc */
    public function uw_saisi(): ?float
    {
        return $this->command->uw_saisi;
    }

    /** @inheritdoc */
    public function epaisseur_lame(): ?float
    {
        return $this->command->epaisseur_lame;
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

    public function __invoke(DeperditionDoubleFenetreCommand $command): self
    {
        $this->command = $command;

        return $this;
    }
}
