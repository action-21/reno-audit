<?php

namespace App\Domain\Baie\Table;

use App\Domain\Baie\Enum\{InclinaisonVitrage, TypeGazLame, TypeVitrage};

interface UgRepository
{
    public function search(
        TypeVitrage $type_vitrage,
        ?TypeGazLame $type_gaz_lame,
        ?InclinaisonVitrage $inclinaison,
        ?bool $vitrage_vir,
    ): UgCollection;
}
