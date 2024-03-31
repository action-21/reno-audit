<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\Table\{Omb, OmbRepository};

class OmbXMLRepository implements OmbRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_omb.xml';
    }

    public function find(Enum $secteur, Enum $orientation, float $hauteur_alpha): ?Omb
    {
        $this->query = \sprintf('//row[enum_secteur_id = "%s"]', $secteur->id());
        $this->query = \sprintf('[enum_orientation_id = "%s"]', $orientation->id());
        $this->query .= \sprintf('[hauteur_alpha_gte = "" or hauteur_alpha_gte >= "%s"]', $hauteur_alpha);
        $this->query .= \sprintf('[hauteur_alpha_lt = "" or hauteur_alpha_lt < "%s"]', $hauteur_alpha);

        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    public function to(XMLElement $record): Omb
    {
        return new Omb(id: $record->id(), omb: (float) $record->omb);
    }
}
