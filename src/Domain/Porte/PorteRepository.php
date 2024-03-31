<?php

namespace App\Domain\Porte;

interface PorteRepository
{
    public function find(\Stringable $reference): ?Porte;
    public function search(\Stringable $reference_audit): PorteCollection;
}
