<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Deperdition\PlancherBas\Table\{Upb0, Upb0Repository};

class Upb0XMLRepository implements Upb0Repository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_upb0.xml';
    }

    public function find(Enum $type_plancher_bas): ?Upb0
    {
        $this->query = \sprintf('//row[enum_type_plancher_bas_id = "%s"]', $type_plancher_bas->id());
        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    public function to(XMLElement $record): Upb0
    {
        return new Upb0(id: $record->id(), upb0: (float) $record->upb0,);
    }
}
