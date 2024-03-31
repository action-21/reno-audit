<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Deperdition\PlancherHaut\Table\{Uph0, Uph0Repository};

class Uph0XMLRepository implements Uph0Repository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_uph0.xml';
    }

    public function find(Enum $type_plancher_haut): ?Uph0
    {
        $this->query = \sprintf('//row[enum_type_plancher_haut_id = "%s"]', $type_plancher_haut->id());
        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    public function to(XMLElement $record): Uph0
    {
        return new Uph0(id: $record->id(), uph0: (float) $record->uph0,);
    }
}
