<?php

namespace App\Domain\Ventilation;

interface VentilationRepository
{
    public function find(\Stringable $reference): ?Ventilation;
    public function search(\Stringable $reference_audit): VentilationCollection;
}
