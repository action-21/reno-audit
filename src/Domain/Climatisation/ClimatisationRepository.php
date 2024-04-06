<?php

namespace App\Domain\Climatisation;

interface ClimatisationRepository
{
    public function find(\Stringable $reference): ?Climatisation;
    public function search(\Stringable $reference_audit): ClimatisationCollection;
    public function save(Climatisation $climatisation): void;
    public function remove(Climatisation $climatisation): void;
}
