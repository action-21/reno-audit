<?php

namespace App\Database\XML\Table;

use App\Domain\Common\Enum;
use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Moteur3CL\Apport\SurfaceSudEquivalente\Table\{CoefficientTransparence, CoefficientTransparenceRepository};

class CoefficientTransparenceXMLRepository implements CoefficientTransparenceRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_t.xml';
    }

    /** @inheritdoc */
    public function find(Enum $meteriaux_menuiserie, ?Enum $type_vitrage, ?bool $vitrage_vir): ?CoefficientTransparence
    {
        $this->query = \sprintf('//row[enum_type_materiaux_menuiserie_id = "%s"]', $meteriaux_menuiserie->id());
        $this->query .= \sprintf('[enum_type_vitrage_id = "" or enum_type_vitrage_id = "%s"]', $type_vitrage?->id());
        $this->query .= \sprintf('[vitrage_vir = "" or vitrage_vir = "%s"]', null !== $vitrage_vir ? (int) $vitrage_vir : null);

        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    protected function to(XMLElement $record): CoefficientTransparence
    {
        return new CoefficientTransparence(id: $record->id(), t: (float) $record->t);
    }
}
