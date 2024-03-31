<?php

namespace App\Command\Simulation\Apport\SurfaceSudEquivalente;

use App\Domain\Common\Enum\Baie\TypeBaie;
use App\Domain\Common\Enum\Menuiserie\{MateriauxMenuiserie, TypePose};
use App\Domain\Common\Enum\Paroi\Orientation;
use App\Domain\Common\Enum\Situation\ZoneClimatique;
use App\Domain\Common\Enum\Vitrage\{InclinaisonVitrage, TypeGazLame, TypeVitrage};
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\{SseBaie, SseDoubleFenetre, SseEts};
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\{SseMasqueProche, SseMasqueProcheCollection, SseMasqueLointain, SseMasqueLointainCollection};
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\Table\{C1Repository, SwRepository};
use App\Domain\Moteur3CL\Deperdition\Paroi\Table\CoefficientReductionDeperditionVerandaRepository;

final class SseBaieHandler
{
    use SseBaie;

    private SseBaieCommand $command;

    public function __construct(
        private SseDoubleFenetreCommand $sse_double_fenetre_handler,
        private SseEtsHandler $sse_ets_handler,
        private SseMasqueProcheHandler $sse_masque_proche_handler,
        private SseMasqueLointainHandler $sse_masque_lointain_handler,
        private CoefficientReductionDeperditionVerandaRepository $table_bver_repository,
        private SwRepository $table_sw_repository,
        private C1Repository $table_c1_repository,
    ) {
    }

    /** @inheritdoc */
    public function surface(): float
    {
        return $this->command->surface;
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
    public function zone_climatique(): ZoneClimatique
    {
        return $this->command->zone_climatique;
    }

    /** @inheritdoc */
    public function orientation(): Orientation
    {
        return $this->command->orientation;
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

    /** @inheritdoc */
    public function double_fenetre(): ?SseDoubleFenetre
    {
        if (null === $this->command->double_fenetre) {
            return null;
        }
        return $this->has('double_fenetre')
            ? $this->get('double_fenetre')
            : $this->set('double_fenetre', ($this->sse_double_fenetre_handler)($this->command->double_fenetre));
    }

    /** @inheritdoc */
    public function ets(): ?SseEts
    {
        if (null === $this->command->ets) {
            return null;
        }
        return $this->has('ets')
            ? $this->get('ets')
            : $this->set('ets', ($this->sse_ets_handler)($this->command->ets));
    }

    /** @inheritdoc */
    public function masque_proche_collection(): SseMasqueProcheCollection
    {
        return $this->has('masque_proche_collection')
            ? $this->get('masque_proche_collection')
            : $this->set('masque_proche_collection', new SseMasqueProcheCollection(\array_map(
                fn (SseMasqueProcheCommand $item): SseMasqueProche => ($this->sse_masque_proche_handler)($item),
                $this->command->masque_proche_collection,
            )));
    }

    /** @inheritdoc */
    public function masque_lointain_collection(): SseMasqueLointainCollection
    {
        return $this->has('masque_lointain_collection')
            ? $this->get('masque_lointain_collection')
            : $this->set('masque_lointain_collection', new SseMasqueLointainCollection(\array_map(
                fn (SseMasqueLointainCommand $item): SseMasqueLointain => ($this->sse_masque_lointain_handler)($item),
                $this->command->masque_lointain_collection,
            )));
    }

    public function __invoke(SseBaieCommand $command): self
    {
        $this->command = $command;

        return $this;
    }
}
