<?php

namespace App\Domain\Mur;

interface MurRepository
{
    public function find(\Stringable $reference): ?Mur;
    public function search(\Stringable $reference_enveloppe): MurCollection;
}
