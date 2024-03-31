<?php

namespace App\Domain\PlancherIntermediaire;

interface PlancherIntermediaireRepository
{
    public function find(\Stringable $reference): ?PlancherIntermediaire;
    public function search(\Stringable $reference_batiment): PlancherIntermediaireCollection;
}
