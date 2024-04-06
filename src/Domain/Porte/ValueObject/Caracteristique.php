<?php

namespace App\Domain\Porte\ValueObject;

use App\Domain\Porte\Enum\{NatureMenuiseriePorte, TypePorte, TypePose};

/**
 * Caractéristiques d'une porte
 */
final class Caracteristique
{
    public readonly NatureMenuiseriePorte $nature_menuiserie;

    public function __construct(
        public readonly float $surface,
        public readonly ?float $largeur_dormant,
        public readonly bool $presence_joint,
        public readonly ?bool $presence_retour_isolation,
        public readonly TypePorte $type_porte,
        public readonly TypePose $type_pose,
    ) {
        $this->nature_menuiserie = NatureMenuiseriePorte::from_type_porte($type_porte);
    }
}
