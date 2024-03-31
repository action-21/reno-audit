<?php

namespace App\Domain\Batiment\Table;

use App\Domain\Common\Enum\Mois;
use App\Domain\Common\Table\TableValue;

/**
 * @see §18.2
 */
class SollicitationExterieure implements TableValue
{
    public function __construct(
        public readonly int $id,
        public readonly Mois $mois,
        public readonly ?float $epv,
        public readonly ?float $e,
        public readonly ?float $efr26,
        public readonly ?float $efr28,
        public readonly ?float $text,
        public readonly ?float $textmoy_clim26,
        public readonly ?float $textmoy_clim28,
        public readonly ?float $nref19,
        public readonly ?float $nref21,
        public readonly ?float $nref26,
        public readonly ?float $nref28,
        public readonly ?float $dh14,
        public readonly ?float $dh19,
        public readonly ?float $dh21,
        public readonly ?float $dh26,
        public readonly ?float $dh28,
        public readonly ?float $tefs,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function mois(): Mois
    {
        return $this->mois;
    }

    public function epv(): ?float
    {
        return $this->epv;
    }

    public function e(): ?float
    {
        return $this->e;
    }

    public function efr26(): ?float
    {
        return $this->efr26;
    }

    public function efr28(): ?float
    {
        return $this->efr28;
    }

    public function text(): ?float
    {
        return $this->text;
    }

    public function textmoy_clim26(): ?float
    {
        return $this->textmoy_clim26;
    }

    public function textmoy_clim28(): ?float
    {
        return $this->textmoy_clim28;
    }

    public function nref19(): ?float
    {
        return $this->nref19;
    }

    public function nref21(): ?float
    {
        return $this->nref21;
    }

    public function nref26(): ?float
    {
        return $this->nref26;
    }

    public function nref28(): ?float
    {
        return $this->nref28;
    }

    public function dh14(): ?float
    {
        return $this->dh14;
    }

    public function dh19(): ?float
    {
        return $this->dh19;
    }

    public function dh21(): ?float
    {
        return $this->dh21;
    }

    public function dh26(): ?float
    {
        return $this->dh26;
    }

    public function dh28(): ?float
    {
        return $this->dh28;
    }

    public function tefs(): ?float
    {
        return $this->tefs;
    }
}
