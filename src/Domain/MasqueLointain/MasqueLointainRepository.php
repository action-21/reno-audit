<?php

namespace App\Domain\MasqueLointain;

interface MasqueLointainRepository
{
    public function find(\Stringable $reference): ?MasqueLointain;
    public function search(\Stringable $reference_enveloppe): MasqueLointainCollection;
    public function save(MasqueLointain $masque_lointain): void;
    public function remove(MasqueLointain $masque_lointain): void;
}
