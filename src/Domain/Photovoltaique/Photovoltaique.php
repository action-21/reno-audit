<?php

namespace App\Domain\Photovolotaique;

use App\Domain\Batiment\Batiment;
use App\Domain\Photovolotaique\Enum\{Inclinaison, Orientation};

final class Photovoltaique
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Batiment $batiment,
        private ?float $surface_totale_capteurs,
        private ?int $nombre_module,
        private ?Inclinaison $orientation,
        private ?Orientation $inclinaison,
    ) {
    }

    public function reference(): \Stringable
    {
        return $this->reference;
    }

    public function batiment(): Batiment
    {
        return $this->batiment;
    }

    public function surface_capteurs_saisie(): ?float
    {
        return $this->surface_totale_capteurs;
    }

    public function modules(): ?int
    {
        return $this->nombre_module;
    }

    public function inclinaison(): ?Inclinaison
    {
        return $this->inclinaison;
    }

    public function orientation(): ?Orientation
    {
        return $this->orientation;
    }
}
