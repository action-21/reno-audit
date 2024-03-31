<?php

namespace App\Database\Api\Opendata\Audit\Model;

use App\Domain\Enveloppe\Mur\Entity\Structure;

class XMLMur extends XMLElement
{
    public function reference(): ?string
    {
        return $this->donnee_entree()->get('reference');
    }

    public function description(): ?string
    {
        return $this->donnee_entree()->get('description');
    }

    public function toStructure(): Structure
}
