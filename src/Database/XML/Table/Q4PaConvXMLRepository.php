<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Deperdition\Ventilation\Table\{Q4paConv, Q4paConvRepository};

class Q4PaConvXMLRepository implements Q4paConvRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_q4pa_conv.xml';
    }

    public function find(
        Enum $periode_construction,
        Enum $type_batiment,
        ?bool $presence_joints_menuiserie,
        ?bool $isolation_murs_plafonds
    ): ?Q4paConv {
        $this->query = \sprintf('//row[enum_periode_construction_id = "%s"]', $periode_construction->id());
        $this->query = \sprintf('[enum_type_batiment_id = "%s"]', $type_batiment->id());
        $this->query .= \sprintf('[presence_joints_menuiserie = "" or presence_joints_menuiserie = "%s"]', null !== $presence_joints_menuiserie ? (int) $presence_joints_menuiserie : null);
        $this->query .= \sprintf('[isolation_murs_plafonds = "" or isolation_murs_plafonds = "%s"]', null !== $isolation_murs_plafonds ? (int) $isolation_murs_plafonds : null);

        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    public function to(XMLElement $record): Q4paConv
    {
        return new Q4paConv(id: $record->id(), q4pa_conv: (float) $record->q4pa_conv);
    }
}
