<?php

namespace App\Database\XML\Table;

use App\Domain\Common\Enum;
use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Moteur3CL\Deperdition\Baie\Table\{Uw, UwCollection, UwRepository};

class UwXMLRepository implements UwRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_uw.xml';
    }

    public function search(Enum $type_baie, Enum $materiaux_menuiserie): UwCollection
    {
        $this->query = \sprintf('//row[enum_type_baie_id = "%s"]', $type_baie->id());
        $this->query .= \sprintf('[enum_type_materiaux_menuiserie_id = "%s"]', $materiaux_menuiserie->id());

        return new UwCollection(\array_map(
            fn (XMLElement $record): Uw => $this->to($record),
            $this->getMany(),
        ));
    }

    protected function to(XMLElement $record): Uw
    {
        return new Uw(
            id: $record->id(),
            ug: $record->ug ? (float) $record->ug : null,
            uw: (float) $record->uw,
        );
    }
}
