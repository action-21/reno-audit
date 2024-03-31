<?php

namespace App\Database\XML\Table;

use App\Domain\Common\Enum;
use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Moteur3CL\Situation\Table\{Tbase, TbaseRepository};

class TbaseXMLRepository implements TbaseRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_tbase.xml';
    }

    public function find(Enum $zone_climatique, Enum $classe_altitude): ?Tbase
    {
        $this->query = \sprintf('//row[enum_zone_climatique_id = "%s"]', $zone_climatique->id());
        $this->query .= \sprintf('[enum_classe_altitude_id = "%s"]', $classe_altitude->id());

        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    protected function to(XMLElement $record): Tbase
    {
        return new Tbase(id: $record->id(), tbase: (float) $record->tbase);
    }
}
