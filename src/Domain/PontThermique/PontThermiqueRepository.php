<?php

namespace App\Domain\PontThermique;

interface PontThermiqueRepository
{
    public function find(\Stringable $reference): ?PontThermique;
    public function search(\Stringable $reference_enveloppe): PontThermiqueCollection;
    public function save(PontThermique $pont_thermique): void;
    public function remove(PontThermique $pont_thermique): void;
}
