<?php

namespace App\Database\XML\Table;

use App\Domain\Common\Enum;
use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Moteur3CL\Deperdition\Baie\Table\{Ug, UgCollection, UgRepository};

class UgXMLRepository implements UgRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_ug.xml';
    }

    public function search(Enum $type_vitrage, ?Enum $type_gaz_lame, ?Enum $inclinaison, ?bool $vitrage_vir): UgCollection
    {
        $this->query = \sprintf('//row[enum_type_vitrage_id = "%s"]', $type_vitrage->id());
        $this->query .= \sprintf('[enum_type_gaz_lame_id = "" or enum_type_gaz_lame_id = "%s"]', $type_gaz_lame?->id());
        $this->query .= \sprintf('[enum_inclinaison_vitrage_id = "" or enum_inclinaison_vitrage_id = "%s"]', $inclinaison?->id());
        $this->query .= \sprintf('[vitrage_vir = "" or vitrage_vir = "%s"]', null !== $vitrage_vir ? (int) $vitrage_vir : null);

        return new UgCollection(\array_map(
            fn (XMLElement $record): Ug => $this->to($record),
            $this->getMany(),
        ));
    }

    protected function to(XMLElement $record): Ug
    {
        return new Ug(
            id: $record->id(),
            epaisseur_lame: $record->epaisseur_lame ? (float) $record->epaisseur_lame : null,
            ug: (float) $record->ug,
        );
    }
}
