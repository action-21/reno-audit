<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Deperdition\Porte\Table\{Uporte, UporteRepository};

class UporteXMLRepository implements UporteRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_uporte.xml';
    }

    public function find(Enum $type_porte): ?Uporte
    {
        $this->query = \sprintf('//row[enum_type_porte_id = "%s"]', $type_porte->id());
        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    public function to(XMLElement $record): Uporte
    {
        return new Uporte(id: $record->id(), uporte: (float) $record->uporte,);
    }
}
