<?php

namespace App\Domain\Batiment;

use App\Domain\Audit\AuditEngine;
use App\Domain\Batiment\Engine\{Eclairage, Occupation, Refroidissement, Situation};
use App\Domain\Enveloppe\EnveloppeEngine;

final class BatimentEngine
{
    private AuditEngine $context;

    public function __construct(
        private Occupation $occupation,
        private Situation $situation,
        private Eclairage $eclairage,
        private Refroidissement $refroidissement,
        private EnveloppeEngine $enveloppe_engine,
    ) {
    }

    public function occupation(): Occupation
    {
        return $this->occupation;
    }

    public function situation(): Situation
    {
        return $this->situation;
    }

    public function eclairage(): Eclairage
    {
        return $this->eclairage;
    }

    public function refroidissement(): Refroidissement
    {
        return $this->refroidissement;
    }

    public function enveloppe_engine(): EnveloppeEngine
    {
        return $this->enveloppe_engine;
    }

    public function context(): AuditEngine
    {
        return $this->context;
    }

    public function input(): Batiment
    {
        return $this->context->input()->batiment();
    }

    public function __invoke(AuditEngine $context): self
    {
        $this->context = $context;
        $this->occupation = ($this->occupation)($this);
        $this->situation = ($this->situation)($this);
        $this->eclairage = ($this->eclairage)($this);
        $this->refroidissement = ($this->refroidissement)($this);
        $this->enveloppe_engine = ($this->enveloppe_engine)($this);

        return $this;
    }
}
