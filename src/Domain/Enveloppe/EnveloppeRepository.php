<?php

namespace App\Domain\Enveloppe;

interface EnveloppeRepository
{
    public function find(\Stringable $referenc_batiment): ?Enveloppe;
    public function save(Enveloppe $enveloppe): void;
}
