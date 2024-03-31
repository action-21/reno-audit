<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Deperdition\Mur\Table\{Umur, UmurRepository};

class UmurXMLRepository implements UmurRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_umur.xml';
    }

    public function find(Enum $zone_climatique, Enum $periode_construction_isolation, bool $effet_joule): ?Umur
    {
        $this->query = \sprintf('//row[enum_zone_climatique_id = "%s"]', $zone_climatique->id());
        $this->query .= \sprintf('[enum_periode_construction_id = "%s"]', $periode_construction_isolation->id());
        $this->query .= \sprintf('[effet_joule = "%s"]', (int) $effet_joule);

        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    public function to(XMLElement $record): Umur
    {
        return new Umur(id: $record->id(), umur: (float) $record->umur,);
    }
}
