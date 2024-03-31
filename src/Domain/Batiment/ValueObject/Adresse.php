<?php

namespace App\Domain\Batiment\ValueObject;

use App\Domain\Batiment\Enum\ZoneClimatique;

/**
 * @property ZoneClimatique $zone_climatique - Zone climatique
 * @property string $label - Libellé de l'adresse
 * @property string $code_postal - Code postal
 * @property string $commune - Commune
 * @property string|null $ban_id - Identifiant BAN
 * @property string|null $rnb_id - Identifiant RNB
 */
final class Adresse
{
    public readonly ZoneClimatique $zone_climatique;

    public function __construct(
        public readonly string $label,
        public readonly string $code_postal,
        public readonly string $commune,
        public readonly ?string $ban_id,
        public readonly ?string $rnb_id,
    ) {
        $this->zone_climatique = ZoneClimatique::fromCodeDepartement($this->code_departement());
    }

    public function code_departement(): string
    {
        return \substr($this->code_postal, 2);
    }
}
