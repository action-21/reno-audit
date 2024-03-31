<?php

namespace App\Domain\MasqueLointain;

interface MasqueLointainRepository
{
    public function find(\Stringable $reference): ?MasqueLointain;
    public function search(\Stringable $reference_batiment): MasqueLointainCollection;
}
