<?php

namespace App\Database\XML\Table;

use App\Domain\Common\Enum;
use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Moteur3CL\Common\Mois;
use App\Domain\Moteur3CL\Eclairage\Table\{Nhecl, NheclCollection, NheclRepository};

class NheclXMLRepository implements NheclRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_nhecl.xml';
    }

    public function search(Enum $zone_climatique): NheclCollection
    {
        $this->query = \sprintf('//row[enum_zone_climatique_id = "%s"]', $zone_climatique->id());

        return new NheclCollection(\array_map(
            fn (XMLElement $record): Nhecl => $this->to($record),
            $this->getMany(),
        ));
    }

    protected function to(XMLElement $record): Nhecl
    {
        return new Nhecl(
            id: $record->id(),
            mois: Mois::from((int) $record->mois_id),
            nhecl: (float) $record->nhecl,
        );
    }
}
