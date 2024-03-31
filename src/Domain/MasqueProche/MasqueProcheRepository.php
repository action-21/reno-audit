<?php

namespace App\Domain\MasqueProche;

interface MasqueProcheRepository
{
    public function find(\Stringable $reference): ?MasqueProche;
    public function search(\Stringable $reference_batiment): MasqueProcheCollection;
}
