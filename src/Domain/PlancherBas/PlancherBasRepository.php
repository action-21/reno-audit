<?php

namespace App\Domain\PlancherBas;

interface PlancherBasRepository
{
    public function find(\Stringable $reference): ?PlancherBas;
    public function search(\Stringable $reference_audit): PlancherBasCollection;
}
