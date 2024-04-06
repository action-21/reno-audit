<?php

namespace App\Command\Simulation\Deperdition\Baie;

use App\Domain\Common\Enum\Baie\{TypeBaie, TypeFermeture};
use App\Domain\Common\Enum\Menuiserie\MateriauxMenuiserie;
use App\Domain\Common\Enum\Paroi\TypeAdjacence;
use App\Domain\Common\Enum\Vitrage\{InclinaisonVitrage, TypeGazLame, TypeVitrage};
use App\Domain\Common\Enum\Situation\ZoneClimatique;
use App\Domain\Moteur3CL\Deperdition\Baie\{DeperditionBaie, DeperditionDoubleFenetre};
use App\Domain\Moteur3CL\Deperdition\Baie\Table\{UgRepository, UwRepository, DeltarRepository, UjnRepository};
use App\Domain\Moteur3CL\Deperdition\Paroi\Table\CoefficientReductionDeperditionRepository;
use App\Domain\Moteur3CL\Deperdition\Paroi\Table\CoefficientReductionDeperditionVerandaRepository;
use App\Domain\Moteur3CL\Deperdition\Paroi\Table\UvueRepository;

final class DeperditionBaieHandler
{
    use DeperditionBaie;

    private DeperditionBaieCommand $command;

    public function __construct(
        private DeperditionDoubleFenetreHandler $deperdition_double_fenetre_handler,
        private UvueRepository $table_uvue_repository,
        private CoefficientReductionDeperditionRepository $table_b_repository,
        private CoefficientReductionDeperditionVerandaRepository $table_bver_repository,
        private UgRepository $table_ug_repository,
        private UwRepository $table_uw_repository,
        private DeltarRepository $table_deltar_repository,
        private UjnRepository $table_ujn_repository,
    ) {
    }

    /** @inheritdoc */
    public function surface(): float
    {
        return $this->command->surface;
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
    public function ujn_saisi(): ?float
    {
        return $this->command->ujn_saisi;
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
    public function type_fermeture(): TypeFermeture
    {
        return $this->command->type_fermeture;
    }

    /** @inheritdoc */
    public function inclinaison_vitrage(): InclinaisonVitrage
    {
        return $this->command->inclinaison_vitrage;
    }

    /** @inheritdoc */
    public function surface_aiu(): ?float
    {
        return $this->command->surface_aiu;
    }

    /** @inheritdoc */
    public function surface_aue(): ?float
    {
        return $this->command->surface_aue;
    }

    /** @inheritdoc */
    public function isolation_aiu(): ?bool
    {
        return $this->command->isolation_aiu;
    }

    /** @inheritdoc */
    public function isolation_aue(): ?bool
    {
        return $this->command->isolation_aue;
    }

    /** @inheritdoc */
    public function isolation(): bool
    {
        return $this->command->isolation;
    }

    /** @inheritdoc */
    public function adjacence_ets(): bool
    {
        return $this->command->adjacence_ets;
    }

    /** @inheritdoc */
    public function orientation_ets_collection(): array
    {
        return $this->command->orientation_ets_collection;
    }

    /** @inheritdoc */
    public function zone_climatique(): ZoneClimatique
    {
        return $this->command->zone_climatique;
    }

    /** @inheritdoc */
    public function type_adjacence(): TypeAdjacence
    {
        return $this->command->type_adjacence;
    }

    /** @inheritdoc */
    public function double_fenetre(): ?DeperditionDoubleFenetre
    {
        if (null === $this->command->double_fenetre) {
            return null;
        }
        return $this->has('double_fenetre')
            ? $this->get('double_fenetre')
            : $this->set('double_fenetre', ($this->deperdition_double_fenetre_handler)($this->command->double_fenetre));
    }

    public function __invoke(DeperditionBaieCommand $command): self
    {
        $this->command = $command;

        return $this;
    }
}
