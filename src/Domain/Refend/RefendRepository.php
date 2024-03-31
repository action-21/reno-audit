<?php

namespace App\Domain\Refend;

interface RefendRepository
{
    public function find(\Stringable $reference): ?Refend;
    public function search(\Stringable $reference_batiment): RefendCollection;
}
