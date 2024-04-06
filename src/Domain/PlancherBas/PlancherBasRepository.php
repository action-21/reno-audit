<?php

namespace App\Domain\PlancherBas;

interface PlancherBasRepository
{
    public function find(\Stringable $reference): ?PlancherBas;
    public function search(\Stringable $reference_enveloppe): PlancherBasCollection;
    public function save(PlancherBas $plancher_bas): void;
    public function remove(PlancherBas $plancher_bas): void;
}
