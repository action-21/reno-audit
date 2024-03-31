<?php

namespace App\Domain\Lnc;

interface LncRepository
{
    public function find(\Stringable $reference): ?Lnc;
    public function search(\Stringable $reference_batiment): LncCollection;
}
