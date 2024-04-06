<?php

namespace App\Domain\Baie\ValueObject;

use App\Domain\Baie\Enum\{TypeBaie, TypePose};

final class Caracteristique
{
    public function __construct(
        public readonly float $surface,
        public readonly ?float $hauteur,
        public readonly ?float $largeur,
        public readonly bool $presence_joint,
        public readonly bool $presence_retour_isolation,
        public readonly float $largeur_dormant,
        public readonly TypeBaie $type_baie,
        public readonly TypePose $type_pose,
    ) {
    }

    public function perimetre(): ?float
    {
        return $this->hauteur && $this->largeur ? 2 * ($this->hauteur + $this->largeur) : null;
    }

    public static function create_from_surface(
        float $surface,
        bool $presence_joint,
        bool $presence_retour_isolation,
        float $largeur_dormant,
        TypeBaie $type_baie,
        TypePose $type_pose,
    ): self
    {
        return new self(
            surface: $surface,
            hauteur: null,
            largeur: null,
            presence_joint: $presence_joint,
            presence_retour_isolation: $presence_retour_isolation,
            largeur_dormant: $largeur_dormant,
            type_baie: $type_baie,
            type_pose: $type_pose,
        );
    }

    public static function create_from_dimensions(
        float $hauteur,
        float $largeur,
        bool $presence_joint,
        bool $presence_retour_isolation,
        float $largeur_dormant,
        TypeBaie $type_baie,
        TypePose $type_pose,
    ): self
    {
        return new self(
            surface: $hauteur * $largeur,
            hauteur: $hauteur,
            largeur: $largeur,
            presence_joint: $presence_joint,
            presence_retour_isolation: $presence_retour_isolation,
            largeur_dormant: $largeur_dormant,
            type_baie: $type_baie,
            type_pose: $type_pose,
        );
    }
}
