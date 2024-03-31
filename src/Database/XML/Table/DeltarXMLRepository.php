<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Deperdition\Baie\Table\{Deltar, DeltarRepository};

class DeltarXMLRepository implements DeltarRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_deltar.xml';
    }

    public function find(Enum $type_fermeture): ?Deltar
    {
        $this->query = \sprintf('//row[enum_type_fermeture_id = "%s"]', $type_fermeture->id());
        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    public function to(XMLElement $record): Deltar
    {
        return new Deltar(id: $record->id(), deltar: (float) $record->deltar,);
    }
}
