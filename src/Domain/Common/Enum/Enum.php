<?php

namespace App\Domain\Common\Enum;

interface Enum
{
    public function id(): int;
    public function lib(): string;
}
