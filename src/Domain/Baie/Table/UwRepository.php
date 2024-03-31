<?php

namespace App\Domain\Baie\Table;

use App\Domain\Baie\Enum\{MateriauxMenuiserie, TypeBaie};

interface UwRepository
{
    public function search(TypeBaie $type_baie, MateriauxMenuiserie $materiaux_menuiserie): UwCollection;
}
