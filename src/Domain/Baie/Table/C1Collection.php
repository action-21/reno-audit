<?php

namespace App\Domain\Baie\Table;

use App\Domain\Common\Enum\Mois;
use App\Domain\Common\Table\TableValueCollection;

/**
 * @property C1[] $values
 */
class C1Collection extends TableValueCollection
{
    public function c1(Mois $mois): ?float
    {
        return \array_filter($this->values, fn (C1 $item): bool => $item->mois() == $mois)[0]?->c1();
    }
}
