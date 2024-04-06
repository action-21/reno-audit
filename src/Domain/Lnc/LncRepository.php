<?php

namespace App\Domain\Lnc;

interface LncRepository
{
    public function find(\Stringable $reference): ?Lnc;
    public function search(\Stringable $reference_enveloppe): LncCollection;
    public function save(Lnc $lnc): void;
    public function remove(Lnc $lnc): void;
}
