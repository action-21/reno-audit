<?php

namespace App\Database\XML\Table;

use App\Domain\Common\Enum;
use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Moteur3CL\Deperdition\PlancherBas\Table\{Ue, UeCollection, UeRepository};

class UeXMLRepository implements UeRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_ue.xml';
    }

    public function search(Enum $type_adjacence, Enum $periode_construction): UeCollection
    {
        $this->query = \sprintf('//row[enum_type_adjacence_id = "%s"]', $type_adjacence->id());
        $this->query .= \sprintf('[enum_periode_construction_id = "" or enum_periode_construction_id = "%s"]', $periode_construction->id());

        return new UeCollection(\array_map(fn (XMLElement $record): Ue => $this->to($record), $this->getMany()));
    }

    protected function to(XMLElement $record): Ue
    {
        return new Ue(id: $record->id(), x: (float) $record->x, y: (float) $record->y, ue: (float) $record->ue,);
    }
}
