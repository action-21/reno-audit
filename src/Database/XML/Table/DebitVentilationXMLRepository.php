<?php

namespace App\Database\XML\Table;

use App\Database\XML\XMLElement;
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Ventilation\Table\{Debit, DebitRepository};

class DebitVentilationXMLRepository extends DebitXMLRepository implements DebitRepository
{
    public function find(Enum $type_ventilation): ?Debit
    {
        $this->query = \sprintf('//row[enum_type_ventilation_id = "%s"]', $type_ventilation->id());
        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    public function to(XMLElement $record): Debit
    {
        return new Debit(
            id: $record->id(),
            qvarep_conv: (float) $record->qvarep_conv,
            qvasouf_conv: (float) $record->qvasouf_conv,
            smea_conv: (float) $record->smea_conv,
        );
    }
}
