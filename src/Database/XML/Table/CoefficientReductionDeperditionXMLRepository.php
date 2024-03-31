<?php

namespace App\Database\XML\Table;

use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Common\Enum;
use App\Domain\Moteur3CL\Common\TableValue;
use App\Domain\Moteur3CL\Deperdition\Common\Table\CoefficientReductionDeperdition;
use App\Domain\Moteur3CL\Deperdition\Common\Table\CoefficientReductionDeperditionRepository;

class CoefficientReductionDeperditionXMLRepository implements CoefficientReductionDeperditionRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_b.xml';
    }

    public function find(
        Enum $type_adjacence,
        ?TableValue $uvue,
        ?bool $isolation_aiu,
        ?bool $isolation_aue,
        ?float $surface_aiu,
        ?float $surface_aue,
    ): ?CoefficientReductionDeperdition {
        $aiu_aue = $surface_aue && $surface_aiu ? $surface_aiu / $surface_aue : null;
        $this->query = \sprintf('//row[enum_type_adjacence_id = "%s"]', $type_adjacence->id());
        $this->query .= \sprintf('[tv_uvue_id = "" or tv_uvue_id = %s]', $uvue?->id());
        $this->query .= \sprintf('[isolation_aiu = "" or isolation_aiu = %s]', null === $isolation_aiu ? (int) $isolation_aiu : null);
        $this->query .= \sprintf('[isolation_aue = "" or isolation_aue = %s]', null === $isolation_aue ? (int) $isolation_aue : null);
        $this->query .= \sprintf('[aiu_aue_min_gt = "" or aiu_aue_min_gt > %s]', $aiu_aue);
        $this->query .= \sprintf('[aiu_aue_min_lte = "" or aiu_aue_min_lte <= %s]', $aiu_aue);

        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    protected function to(XMLElement $record): CoefficientReductionDeperdition
    {
        return new CoefficientReductionDeperdition(id: $record->id(), b: (float) $record->b,);
    }
}
