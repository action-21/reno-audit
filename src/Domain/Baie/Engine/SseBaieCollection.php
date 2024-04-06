<?php

namespace App\Domain\Baie\Engine;

use App\Domain\Baie\{Baie, BaieEngine};
use App\Domain\Common\Enum\Mois;

final class SseBaieCollection
{
    /**
     * @var SseBaie[]
     */
    private array $collection;

    private function __construct(private SseBaie $sse_baie)
    {
    }

    /**
     * Somme des surfaces sud équivalentes pour le mois j (m²)
     */
    public function sse_j(Mois $mois): float
    {
        return \array_reduce($this->collection, fn (SseBaie $item, float $sse): float => $sse += $item->sse_j($mois), 0);
    }

    /**
     * @return SseBaie[]
     */
    public function to_array(): array
    {
        return $this->collection;
    }

    public function __invoke(BaieEngine $engine): self
    {
        $this->collection = \array_map(
            fn (Baie $item): SseBaie => ($this->sse_baie)($item, $engine),
            $engine->input()->to_array(),
        );

        return $this;
    }
}
