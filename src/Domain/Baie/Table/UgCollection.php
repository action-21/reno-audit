<?php

namespace App\Domain\Baie\Table;

use App\Domain\Common\Table\TableValueCollection;

/**
 * @property Ug[] $values
 */
class UgCollection extends TableValueCollection
{
    public function ug(float $epaisseur_lame): ?float
    {
        return $this->find($epaisseur_lame)?->ug();
    }

    /**
     * Recherche la valeur tabulaire correspondant à x avec x = épaisseur de la lame d'air
     *      1. On trie les valeurs par épaisseur de lame croissante (avec null = 0)
     *      2. On retourne la première occurence dont l'épaisseur de la lame est supérieure ou égale à x
     *      3. On retourne la dernière valeur de la table par défaut
     */
    public function find(float $epaisseur_lame): ?Ug
    {
        $collection = $this->usort(fn (Ug $a, Ug $b): int => \round(
            (float) $a->epaisseur_lame() - (float) $b->epaisseur_lame()
        ));
        foreach ($collection->values as $item) {
            if ($epaisseur_lame <= $item->epaisseur_lame()) {
                return $item;
            }
        }
        return $collection->last();
    }

    public function first(): ?Ug
    {
        return \reset($this->values) ?? null;
    }

    public function last(): ?Ug
    {
        return \end($this->values) ?? null;
    }
}
