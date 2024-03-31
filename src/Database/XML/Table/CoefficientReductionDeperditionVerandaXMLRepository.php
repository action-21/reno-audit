<?php

namespace App\Database\XML\Table;

use App\Domain\Common\Enum;
use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Moteur3CL\Deperdition\Common\Table\CoefficientReductionDeperditionVeranda;
use App\Domain\Moteur3CL\Deperdition\Common\Table\CoefficientReductionDeperditionVerandaCollection;
use App\Domain\Moteur3CL\Deperdition\Common\Table\CoefficientReductionDeperditionVerandaRepository;

class CoefficientReductionDeperditionVerandaXMLRepository implements CoefficientReductionDeperditionVerandaRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_bver.xml';
    }

    /** @inheritdoc */
    public function search(Enum $zone_climatique, bool $isolation_paroi): CoefficientReductionDeperditionVerandaCollection
    {
        $this->query = \sprintf('//row[enum_zone_climatique_id = "%s"]', $zone_climatique->id());
        $this->query .= \sprintf('[isolation_paroi = "%s"]', (int) $isolation_paroi);

        return new CoefficientReductionDeperditionVerandaCollection(\array_map(
            fn (XMLElement $record): CoefficientReductionDeperditionVeranda => $this->to($record),
            $this->getMany(),
        ));
    }

    protected function to(XMLElement $record): CoefficientReductionDeperditionVeranda
    {
        return new CoefficientReductionDeperditionVeranda(
            id: $record->id(),
            orientations: (array) $record->enum_orientation_id,
            bver: (float) $record->bver
        );
    }
}
