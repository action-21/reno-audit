<?php

namespace App\Domain\Common\Store;

class DataObject
{
    private array $data = [];

    public function clear(): self
    {
        $this->data = [];
        return $this;
    }

    public function has(string $key): bool
    {
        return \array_key_exists($key, $this->data);
    }

    public function get(string $key): mixed
    {
        return $this->has($key) ? $this->data[$key] : null;
    }

    public function set(string $key, mixed $value): mixed
    {
        $this->data[$key] = $value;
        return $value;
    }

    public function __to_array(): array
    {
        return $this->data;
    }
}
