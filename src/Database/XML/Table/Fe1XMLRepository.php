<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\Table\{Fe1, Fe1Repository};

class Fe1XMLRepository implements Fe1Repository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_fe1.xml';
    }

    public function find(Enum $type_masque_proche, ?Enum $orientation, ?float $avancee): ?Fe1
    {
        $this->query = \sprintf('//row[enum_type_masque_proche_id = "%s"]', $type_masque_proche->id());
        $this->query .= \sprintf('[enum_orientation_id = "" or enum_orientation_id = "%s"]', $orientation?->id());
        $this->query .= \sprintf('[avancee_gte = "" or avancee_gte >= "%s"]', $avancee);
        $this->query .= \sprintf('[avancee_lt = "" or avancee_lt < "%s"]', $avancee);

        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    public function to(XMLElement $record): Fe1
    {
        return new Fe1(id: $record->id(), fe1: (float) $record->fe1);
    }
}
