<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Deperdition\Mur\Table\{Umur0, Umur0Collection, Umur0Repository};

class Umur0XMLRepository implements Umur0Repository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_umur0.xml';
    }

    public function find(Enum $materiaux_structure, ?float $epaisseur_structure): ?Umur0
    {
        $this->query = \sprintf('//row[enum_materiaux_structure_mur_id = "%s"]', $materiaux_structure->id());
        $this->query .= \sprintf('[epaisseur_structure = "%s"]', $epaisseur_structure);

        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    public function search(Enum $materiaux_structure): Umur0Collection
    {
        $this->query = \sprintf('//row[enum_materiaux_structure_mur_id = "%s"]', $materiaux_structure->id());

        return new Umur0Collection(\array_map(
            fn (XMLElement $record): Umur0 => $this->to($record),
            $this->getMany(),
        ));
    }

    public function to(XMLElement $record): Umur0
    {
        return new Umur0(
            id: $record->id(),
            epaisseur_structure: $record->epaisseur_structure ? (float) $record->epaisseur_structure : null,
            umur0: (float) $record->umur0,
        );
    }
}
