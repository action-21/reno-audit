<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\Table\{C1, C1Collection, C1Repository};
use App\Domain\Moteur3CL\Common\Mois;

class C1XMLRepository implements C1Repository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_c1.xml';
    }

    public function search(
        Enum $zone_climatique,
        Enum $orientation,
        Enum $inclinaison_vitrage
    ): C1Collection {
        $this->query = \sprintf('//row[enum_zone_climatique_id = "%s"]', $zone_climatique->id());
        $this->query .= \sprintf('[enum_orientation_id = "%s"]', $orientation->id());
        $this->query .= \sprintf('[enum_inclinaison_vitrage_id = "%s"]', $inclinaison_vitrage->id());

        return new C1Collection(\array_map(
            fn (XMLElement $record): C1 => $this->to($record),
            $this->getMany(),
        ));
    }

    protected function to(XMLElement $record): C1
    {
        return new C1(
            id: $record->id(),
            mois: Mois::from((int) $record->mois_id),
            c1: (float) $record->c1,
        );
    }
}
