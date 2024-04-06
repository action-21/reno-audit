<?php

namespace App\Domain\Baie;

interface BaieRepository
{
    public function find(\Stringable $reference): ?Baie;
    public function search(\Stringable $reference_audit): BaieCollection;
    public function save(Baie $baie): void;
    public function remove(Baie $baie): void;
}
