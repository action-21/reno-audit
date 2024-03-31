<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Deperdition\PlancherBas\Table\{Upb, UpbRepository};

class UpbXMLRepository implements UpbRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_upb.xml';
    }

    public function find(Enum $zone_climatique, Enum $periode_construction_isolation, bool $effet_joule): ?Upb
    {
        $this->query = \sprintf('//row[enum_zone_climatique_id = "%s"]', $zone_climatique->id());
        $this->query .= \sprintf('[enum_periode_construction_id = "%s"]', $periode_construction_isolation->id());
        $this->query .= \sprintf('[effet_joule = "%s"]', (int) $effet_joule);

        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    public function to(XMLElement $record): Upb
    {
        return new Upb(id: $record->id(), upb: (float) $record->upb,);
    }
}
