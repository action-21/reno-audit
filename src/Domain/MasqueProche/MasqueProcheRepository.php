<?php

namespace App\Domain\MasqueProche;

interface MasqueProcheRepository
{
    public function find(\Stringable $reference): ?MasqueProche;
    public function search(\Stringable $reference_enveloppe): MasqueProcheCollection;
    public function save(MasqueProche $masque_proche): void;
    public function remove(MasqueProche $masque_proche): void;
}
