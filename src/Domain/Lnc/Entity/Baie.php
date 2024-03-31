<?php

namespace App\Domain\Lnc\Entity;

use App\Domain\Baie\Enum\{InclinaisonVitrage, MateriauxMenuiserie, TypeVitrage};
use App\Domain\Common\Identifier\Uuid;
use App\Domain\Lnc\Lnc;
use App\Domain\Paroi\Enum\Orientation;

/**
 * Baie d'un espace tampon solarisé donnant sur l'extérieur
 * 
 * @see https://gitlab.com/observatoire-dpe/observatoire-dpe/-/issues/118
 */
final class Baie
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Lnc $local_non_chauffe,
        private string $description,
        private float $surface,
        private ?bool $vitrage_vir,
        private Orientation $orientation,
        private MateriauxMenuiserie $type_materiaux_menuiserie,
        private ?TypeVitrage $type_vitrage,
        private InclinaisonVitrage $inclinaison_vitrage,
    ) {
    }

    public static function create(
        Lnc $local_non_chauffe,
        string $description,
        float $surface,
        Orientation $orientation,
        InclinaisonVitrage $inclinaison_vitrage,
        MateriauxMenuiserie $type_materiaux_menuiserie,
        TypeVitrage $type_vitrage,
        bool $vitrage_vir,
    ): self {
        return new self(
            reference: Uuid::create(),
            local_non_chauffe: $local_non_chauffe,
            description: $description,
            surface: $surface,
            orientation: $orientation,
            type_materiaux_menuiserie: $type_materiaux_menuiserie,
            inclinaison_vitrage: $inclinaison_vitrage,
            type_vitrage: $type_vitrage,
            vitrage_vir: $vitrage_vir,
        );
    }

    public static function create_baie_polycarbonate(
        Lnc $local_non_chauffe,
        string $description,
        float $surface,
        Orientation $orientation,
        InclinaisonVitrage $inclinaison_vitrage,
        ?TypeVitrage $type_vitrage,
        ?bool $vitrage_vir,
    ): self {
        return new self(
            reference: Uuid::create(),
            local_non_chauffe: $local_non_chauffe,
            description: $description,
            surface: $surface,
            orientation: $orientation,
            type_materiaux_menuiserie: MateriauxMenuiserie::POLYCARBONATE,
            inclinaison_vitrage: $inclinaison_vitrage,
            type_vitrage: $type_vitrage,
            vitrage_vir: $vitrage_vir,
        );
    }

    public function update(
        string $description,
        float $surface,
        Orientation $orientation,
        InclinaisonVitrage $inclinaison_vitrage,
    ): self {
        $this->description = $description;
        $this->surface = $surface;
        $this->orientation = $orientation;
        $this->inclinaison_vitrage = $inclinaison_vitrage;
        return $this;
    }

    public function set_baie(
        MateriauxMenuiserie $type_materiaux_menuiserie,
        TypeVitrage $type_vitrage,
        bool $vitrage_vir
    ): self {
        $this->type_materiaux_menuiserie = $type_materiaux_menuiserie;
        $this->type_vitrage = $type_vitrage;
        $this->vitrage_vir = $vitrage_vir;
        return $this;
    }

    public function set_baie_polycarbonate(?TypeVitrage $type_vitrage = null, ?bool $vitrage_vir = null): self
    {
        $this->type_materiaux_menuiserie = MateriauxMenuiserie::POLYCARBONATE;
        $this->type_vitrage = $type_vitrage;
        $this->vitrage_vir = $vitrage_vir;
        return $this;
    }

    public function reference(): \Stringable
    {
        return $this->reference;
    }

    public function local_non_chauffe(): Lnc
    {
        return $this->local_non_chauffe;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function surface(): float
    {
        return $this->surface;
    }

    public function vitrage_vir(): ?bool
    {
        return $this->vitrage_vir;
    }

    public function orientation(): Orientation
    {
        return $this->orientation;
    }

    public function type_materiaux_menuiserie(): ?MateriauxMenuiserie
    {
        return $this->type_materiaux_menuiserie;
    }

    public function type_vitrage(): ?TypeVitrage
    {
        return $this->type_vitrage;
    }

    public function inclinaison_vitrage(): InclinaisonVitrage
    {
        return $this->inclinaison_vitrage;
    }
}
