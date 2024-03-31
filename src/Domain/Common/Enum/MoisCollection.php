<?php

namespace App\Domain\Common\Enum;

class MoisCollection
{
    private array $values = [];

    public function has(Mois $mois): bool
    {
        return \array_key_exists($mois->id(), $this->values);
    }

    public function get(Mois $mois): mixed
    {
        return $this->has($mois) ? $this->values[$mois->id()] : false;
    }

    public function set(Mois $mois, mixed $value): mixed
    {
        $this->values[$mois->id()] = $value;

        return $value;
    }

    public function reduce(\Closure $func, $initial = null): mixed
    {
        return array_reduce($this->values, $func, $initial);
    }
}
