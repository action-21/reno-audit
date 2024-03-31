<?php

namespace App\Database\Api\Opendata\Audit;

use App\Domain\Audit\Audit;
use App\Domain\Audit\AuditRepository;

class AuditOpendataRepository implements AuditRepository
{
    public function find(\Stringable $id): ?Audit
    {
        return null;
    }
}
