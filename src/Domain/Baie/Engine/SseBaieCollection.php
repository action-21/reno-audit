<?php

namespace App\Domain\Baie\Engine;

/**
 * @property SseBaie[] $values
 */
final class SseBaieCollection
{
    private function __construct(public readonly array $values)
    {
    }

    /**
     * Somme des surfaces sud équivalentes pour le mois j (m²)
     */
    public function sse_j(Mois $mois): float
    {
        return \array_reduce($this->values, fn (SseBaie $item, float $sse): float => $sse += $item->sse_j($mois), 0);
    }
}
