<?php

namespace App\Domain\Lnc;

use App\Domain\Batiment\Batiment;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\Lnc\Entity\{Baie, BaieCollection, Paroi, ParoiCollection};
use App\Domain\Lnc\Enum\TypeLnc;

/**
 * Local non chauffé
 */
final class Lnc
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Batiment $batiment,
        private string $description,
        private TypeLnc $type_lnc,
        private BaieCollection $baie_collection,
        private ParoiCollection $paroi_collection,
    ) {
    }

    public static function create(Batiment $batiment, string $description, TypeLnc $type_lnc): self
    {
        return new self(
            reference: Uuid::create(),
            batiment: $batiment,
            description: $description,
            type_lnc: $type_lnc,
            baie_collection: new BaieCollection,
            paroi_collection: new ParoiCollection,
        );
    }

    public function update(string $description, TypeLnc $type_lnc): self
    {
        $this->description = $description;
        $this->type_lnc = $type_lnc;
        return $this;
    }

    public function reference(): \Stringable
    {
        return $this->reference;
    }

    public function batiment(): Batiment
    {
        return $this->batiment;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function isolation_aiu(): bool
    {
        return $this->batiment->paroi_collection()->search_by_local_non_chauffe($this)->est_isole();
    }

    public function isolation_aue(): bool
    {
        return $this->paroi_collection()->isolation();
    }

    public function surface_aiu(): float
    {
        return $this->batiment->paroi_collection()->search_by_local_non_chauffe($this)->surface_deperditive();
    }

    public function surface_aue(): float
    {
        return $this->paroi_collection()->surface();
    }

    public function type_lnc(): TypeLnc
    {
        return $this->type_lnc;
    }

    /**
     * Espace tampon solarisé
     */
    public function ets(): bool
    {
        return $this->type_lnc() === TypeLnc::ESPACE_TAMPON_SOLARISE;
    }

    public function baie_collection(): BaieCollection
    {
        return $this->baie_collection;
    }

    public function addBaie(Baie $baie): self
    {
        $this->baie_collection->add($baie);
        return $this;
    }

    public function paroi_collection(): ParoiCollection
    {
        return $this->paroi_collection;
    }

    public function addParoi(Paroi $paroi): self
    {
        $this->paroi_collection->add($paroi);
        return $this;
    }
}
