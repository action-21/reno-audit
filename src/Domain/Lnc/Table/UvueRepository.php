<?php

namespace App\Domain\Lnc\Table;

use App\Domain\Lnc\Enum\TypeLnc;

interface UvueRepository
{
    public function find(TypeLnc $type_lnc): ?Uvue;
}
