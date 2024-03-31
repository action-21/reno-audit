<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Deperdition\Common\Table\{Uvue, UvueRepository};

class UvueXMLRepository implements UvueRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_uvue.xml';
    }

    public function find(Enum $type_lnc): ?Uvue
    {
        $this->query = \sprintf('//row[enum_type_lnc_id = "%s"]', $type_lnc->id());
        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    protected function to(XMLElement $record): Uvue
    {
        return new Uvue(id: $record->id(), uvue: (float) $record->uvue);
    }
}
