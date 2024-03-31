<?php

namespace App\Domain\Audit;

interface AuditRepository
{
    public function find(\Stringable $reference): ?Audit;
}
