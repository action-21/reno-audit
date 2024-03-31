<?php

namespace App\Domain\Baie\ValueObject;

use App\Domain\Baie\Enum\TypeBaie;
use App\Domain\Paroi\Enum\TypePose;

final class Caracteristique
{
    public function __construct(
        public readonly float $surface,
        public readonly ?float $hauteur,
        public readonly ?float $largeur,
        public readonly TypeBaie $type_baie,
        public readonly TypePose $type_pose,
    ) {
    }

    public function perimetre(): ?float
    {
        return $this->hauteur && $this->largeur ? 2 * ($this->hauteur + $this->largeur) : null;
    }
}
