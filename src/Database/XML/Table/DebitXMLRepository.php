<?php

namespace App\Database\XML\Table;

use App\Database\XML\XMLRepository;

abstract class DebitXMLRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_debit.xml';
    }
}
