<?php

namespace App\Domain\PlancherHaut;

interface PlancherHautRepository
{
    public function find(\Stringable $reference): ?PlancherHaut;
    public function search(\Stringable $reference_enveloppe): PlancherHautCollection;
    public function save(PlancherHaut $plancher_haut): void;
    public function remove(PlancherHaut $plancher_haut): void;
}
