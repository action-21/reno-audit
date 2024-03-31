<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Moteur3CL\Common\TableValue;
use App\Domain\Moteur3CL\Deperdition\Baie\Table\{Ujn, UjnCollection, UjnRepository};

class UjnXMLRepository implements UjnRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_ujn.xml';
    }

    public function search(TableValue $deltar): UjnCollection
    {
        $this->query = \sprintf('//row[deltar_id = "%s"]', $deltar->id());

        return new UjnCollection(\array_map(
            fn (XMLElement $record): Ujn => $this->to($record),
            $this->getMany(),
        ));
    }

    protected function to(XMLElement $record): Ujn
    {
        return new Ujn(
            id: $record->id(),
            uw: (float) $record->uw,
            ujn: (float) $record->ujn,
        );
    }
}
