<?php

namespace App\Domain\Batiment;

interface BatimentRepository
{
    public function find(\Stringable $reference): ?Batiment;
}
