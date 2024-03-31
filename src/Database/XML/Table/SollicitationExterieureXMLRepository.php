<?php

namespace App\Database\XML\Table;

use App\Domain\Common\Enum;
use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Moteur3CL\Common\Mois;
use App\Domain\Moteur3CL\Situation\Table\{SollicitationExterieure, SollicitationExterieureCollection, SollicitationExterieureRepository};

class SollicitationExterieureXMLRepository implements SollicitationExterieureRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_ext.xml';
    }

    public function search(Enum $zone_climatique, Enum $classe_altitude, bool $parois_anciennes_lourdes): SollicitationExterieureCollection
    {
        $this->query = \sprintf('//row[enum_zone_climatique_id = "%s"]', $zone_climatique->id());
        $this->query .= \sprintf('[enum_classe_altitude_id = "%s"]', $classe_altitude->id());
        $this->query .= \sprintf('[parois_anciennes_lourdes = "%s"]', (int) $parois_anciennes_lourdes);

        return new SollicitationExterieureCollection(\array_map(
            fn (XMLElement $record): SollicitationExterieure => $this->to($record),
            $this->getMany(),
        ));
    }

    protected function to(XMLElement $record): SollicitationExterieure
    {
        return new SollicitationExterieure(
            id: $record->id(),
            mois: Mois::from((int) $record->mois_id),
            epv: (float) $record->epv,
            e: (string) $record->e ? (float) $record->e : null,
            efr26: (string) $record->efr26 ? (float) $record->efr26 : null,
            efr28: (string) $record->efr28 ? (float) $record->efr28 : null,
            text: (string) $record->text ? (float) $record->text : null,
            textmoy_clim26: (string) $record->textmoy_clim26 ? (float) $record->textmoy_clim26 : null,
            textmoy_clim28: (string) $record->textmoy_clim28 ? (float) $record->textmoy_clim28 : null,
            nref19: (string) $record->nref19 ? (float) $record->nref19 : null,
            nref21: (string) $record->nref21 ? (float) $record->nref21 : null,
            nref26: (string) $record->nref26 ? (float) $record->nref26 : null,
            nref28: (string) $record->nref28 ? (float) $record->nref28 : null,
            dh14: (string) $record->dh14 ? (float) $record->dh14 : null,
            dh19: (string) $record->dh19 ? (float) $record->dh19 : null,
            dh21: (string) $record->dh21 ? (float) $record->dh21 : null,
            dh26: (string) $record->dh26 ? (float) $record->dh26 : null,
            dh28: (string) $record->dh28 ? (float) $record->dh28 : null,
            tefs: (string) $record->tefs ? (float) $record->tefs : null
        );
    }
}
