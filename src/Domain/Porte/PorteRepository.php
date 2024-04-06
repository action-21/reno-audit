<?php

namespace App\Domain\Porte;

interface PorteRepository
{
    public function find(\Stringable $reference): ?Porte;
    public function search(\Stringable $reference_enveloppe): PorteCollection;
    public function save(Porte $porte): void;
    public function remove(Porte $porte): void;
}
