<?php

namespace App\Domain\Baie\Table;

interface UjnRepository
{
    public function search(Deltar $deltar): UjnCollection;
}
