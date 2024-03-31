<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\Table\{Fe2, Fe2Repository};

class Fe2XMLRepository implements Fe2Repository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_fe2.xml';
    }

    public function find(Enum $orientation, float $hauteur_alpha): ?Fe2
    {
        $this->query = \sprintf('//row[enum_orientation_id = "%s"]', $orientation->id());
        $this->query .= \sprintf('[hauteur_alpha_gte = "" or hauteur_alpha_gte >= "%s"]', $hauteur_alpha);
        $this->query .= \sprintf('[hauteur_alpha_lt = "" or hauteur_alpha_lt < "%s"]', $hauteur_alpha);

        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    public function to(XMLElement $record): Fe2
    {
        return new Fe2(id: $record->id(), fe2: (float) $record->fe2);
    }
}
