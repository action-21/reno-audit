<?php

namespace App\Domain\PontThermique\ValueObject;

/**
 * Caractéristique d'un pont thermique
 */
final class Caracteristique
{
    public function __construct(
        public readonly float $longueur,
        public readonly bool $pont_thermique_partiel,
    ) {
    }
}
