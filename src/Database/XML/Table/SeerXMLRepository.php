<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Refroidissement\Table\{Seer, SeerRepository};

class SeerXMLRepository implements SeerRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_seer.xml';
    }

    public function find(Enum $zone_climatique, Enum $periode_installation): ?Seer
    {
        $this->query = \sprintf('//row[enum_zone_climatique_id = "%s"]', $zone_climatique->id());
        $this->query = \sprintf('[enum_periode_installation_id = "%s"]', $periode_installation->id());
        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    public function to(XMLElement $record): Seer
    {
        return new Seer(id: $record->id(), eer: (float) $record->eer,);
    }
}
