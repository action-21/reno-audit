<?php

namespace App\Database\Api\Opendata\Audit\Model;

abstract class XMLElement extends \SimpleXMLElement
{
    public function donnee_entree(): self
    {
        return $this->donnee_entree;
    }

    public function donnee_intermediaire(): self
    {
        return $this->donnee_intermediaire;
    }

    public function get(string $propery): ?string
    {
        return (string) $this->{$propery} ? $this->{$propery} : null;
    }
}
