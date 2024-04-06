<?php

namespace App\Domain\PlancherIntermediaire;

interface PlancherIntermediaireRepository
{
    public function find(\Stringable $reference): ?PlancherIntermediaire;
    public function search(\Stringable $reference_enveloppe): PlancherIntermediaireCollection;
    public function save(PlancherIntermediaire $plancher_intermediaire): void;
    public function remove(PlancherIntermediaire $plancher_intermediaire): void;
}
