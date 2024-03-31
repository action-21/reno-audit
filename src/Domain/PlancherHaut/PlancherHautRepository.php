<?php

namespace App\Domain\PlancherHaut;

interface PlancherHautRepository
{
    public function find(\Stringable $reference): ?PlancherHaut;
    public function search(\Stringable $reference_audit): PlancherHautCollection;
}
