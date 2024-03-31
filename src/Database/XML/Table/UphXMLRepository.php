<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Deperdition\PlancherHaut\Table\{Uph, UphRepository};

class UphXMLRepository implements UphRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_uph.xml';
    }

    public function find(
        Enum $zone_climatique,
        Enum $periode_construction_isolation,
        Enum $type_toiture,
        bool $effet_joule
    ): ?Uph {
        $this->query = \sprintf('//row[enum_zone_climatique_id = "%s"]', $zone_climatique->id());
        $this->query .= \sprintf('[enum_periode_construction_isolation_id = "%s"]', $periode_construction_isolation->id());
        $this->query .= \sprintf('[enum_type_toiture_id = "%s"]', $type_toiture->id());
        $this->query .= \sprintf('[effet_joule = "%s"]', (int) $effet_joule);

        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    public function to(XMLElement $record): Uph
    {
        return new Uph(id: $record->id(), uph: (float) $record->uph,);
    }
}
