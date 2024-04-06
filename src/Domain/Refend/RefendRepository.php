<?php

namespace App\Domain\Refend;

interface RefendRepository
{
    public function find(\Stringable $reference): ?Refend;
    public function search(\Stringable $reference_enveloppe): RefendCollection;
    public function save(Refend $refend): void;
    public function remove(Refend $refend): void;
}
