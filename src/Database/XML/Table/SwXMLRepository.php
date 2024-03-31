<?php

namespace App\Database\XML\Table;

use App\Domain\Common\Enum;
use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\Table\{Sw, SwRepository};

class SwXMLRepository implements SwRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_sw.xml';
    }

    public function find(
        Enum $type_baie,
        Enum $materiaux_menuiserie,
        ?Enum $type_pose,
        ?Enum $type_vitrage,
        ?bool $vitrage_vir
    ): ?Sw {
        $this->query = \sprintf('//row[enum_type_baie_id = "%s"]', $type_baie->id());
        $this->query .= \sprintf('[enum_type_materiaux_menuiserie_id = "%s"]', $materiaux_menuiserie->id());
        $this->query .= \sprintf('[enum_type_pose_id = "" or enum_type_pose_id = "%s"]', $type_pose?->id());
        $this->query .= \sprintf('[enum_type_vitrage_id = "" or enum_type_vitrage_id = "%s"]', $type_vitrage?->id());
        $this->query .= \sprintf('[vitrage_vir = "" or vitrage_vir = "%s"]', null !== $vitrage_vir ? (int) $vitrage_vir : null);

        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    protected function to(XMLElement $record): Sw
    {
        return new Sw(id: $record->id(), sw: (float) $record->sw,);
    }
}
