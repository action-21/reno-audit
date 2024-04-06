<?php

namespace App\Domain\Enveloppe;

use App\Domain\Baie\BaieEngine;
use App\Domain\Batiment\BatimentEngine;
use App\Domain\Enveloppe\Engine\{Apport, Deperdition};
use App\Domain\Enveloppe\Enveloppe;
use App\Domain\Lnc\LncEngine;
use App\Domain\MasqueLointain\MasqueLointainEngine;
use App\Domain\MasqueProche\MasqueProcheEngine;
use App\Domain\Mur\MurEngine;
use App\Domain\PlancherBas\PlancherBasEngine;
use App\Domain\PlancherHaut\PlancherHautEngine;
use App\Domain\PontThermique\PontThermiqueEngine;
use App\Domain\Porte\PorteEngine;

final class EnveloppeEngine
{
    private BatimentEngine $context;

    public function __construct(
        private LncEngine $lnc_engine,
        private MasqueProcheEngine $masque_proche_engine,
        private MasqueLointainEngine $masque_lointain_engine,
        private BaieEngine $baie_engine,
        private MurEngine $mur_engine,
        private PlancherBasEngine $plancher_bas_engine,
        private PlancherHautEngine $plancher_haut_engine,
        private PorteEngine $porte_engine,
        private PontThermiqueEngine $pont_thermique_engine,
        private Deperdition $deperdition,
        private Apport $apport,
    ) {
    }

    public function deperdition(): Deperdition
    {
        return $this->deperdition;
    }

    public function apport(): Apport
    {
        return $this->apport;
    }

    public function baie_engine(): BaieEngine
    {
        return $this->baie_engine;
    }

    public function lnc_engine(): LncEngine
    {
        return $this->lnc_engine;
    }

    public function masque_proche_engine(): MasqueProcheEngine
    {
        return $this->masque_proche_engine;
    }

    public function masque_lointain_engine(): MasqueLointainEngine
    {
        return $this->masque_lointain_engine;
    }

    public function mur_engine(): MurEngine
    {
        return $this->mur_engine;
    }

    public function plancher_bas_engine(): PlancherBasEngine
    {
        return $this->plancher_bas_engine;
    }

    public function plancher_haut_engine(): PlancherHautEngine
    {
        return $this->plancher_haut_engine;
    }

    public function porte_engine(): PorteEngine
    {
        return $this->porte_engine;
    }

    public function pont_thermique_engine(): PontThermiqueEngine
    {
        return $this->pont_thermique_engine;
    }

    public function input(): Enveloppe
    {
        return $this->context->input()->enveloppe();
    }

    public function context(): BatimentEngine
    {
        return $this->context;
    }

    public function __invoke(BatimentEngine $context): self
    {
        $this->context = $context;
        $this->lnc_engine = ($this->lnc_engine)($this);
        $this->masque_proche_engine = ($this->masque_proche_engine)($this);
        $this->masque_lointain_engine = ($this->masque_lointain_engine)($this);
        $this->baie_engine = ($this->baie_engine)($this);
        $this->mur_engine = ($this->mur_engine)($this);
        $this->plancher_haut_engine = ($this->plancher_haut_engine)($this);
        $this->plancher_bas_engine = ($this->plancher_bas_engine)($this);
        $this->porte_engine = ($this->porte_engine)($this);
        $this->pont_thermique_engine = ($this->pont_thermique_engine)($this);
        $this->deperdition = ($this->deperdition)($this);
        $this->apport = ($this->apport)($this);

        return $this;
    }
}
