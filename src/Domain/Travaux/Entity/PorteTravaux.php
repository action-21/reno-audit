<?php

namespace App\Domain\Audit\Travaux\Entity;

use App\Domain\Audit\Travaux\Travaux;
use App\Domain\Baie\Enum\TypePose;
use App\Domain\Porte\Enum\TypePorte;
use App\Domain\Common\Identifier\Uuid;

final class PorteTravaux
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly Travaux $travaux,
        private readonly \Stringable $reference_porte,
        private ?float $uporte_saisi,
        private ?float $largeur_dormant,
        private ?bool $presence_joint,
        private ?bool $presence_retour_isolation,
        private ?TypePorte $type_porte,
        private ?TypePose $type_pose,
    ) {
    }

    public static function create(
        \Stringable $reference_porte,
        Travaux $travaux,
        ?float $uporte_saisi,
        ?float $largeur_dormant,
        ?bool $presence_joint,
        ?bool $presence_retour_isolation,
        ?TypePorte $type_porte,
        ?TypePose $type_pose,
    ): self {
        return new self(
            reference: Uuid::create(),
            travaux: $travaux,
            reference_porte: $reference_porte,
            largeur_dormant: $largeur_dormant,
            uporte_saisi: $uporte_saisi,
            presence_joint: $presence_joint,
            presence_retour_isolation: $presence_retour_isolation,
            type_porte: $type_porte,
            type_pose: $type_pose,
        );
    }

    public function reference(): \Stringable
    {
        return $this->reference;
    }

    public function reference_porte(): \Stringable
    {
        return $this->reference_porte;
    }

    public function isolation(): bool
    {
        return $this->type_porte->isolation();
    }

    public function uporte_saisi(): ?float
    {
        return $this->uporte_saisi;
    }

    public function largeur_dormant(): ?float
    {
        return $this->largeur_dormant;
    }

    public function presence_joint(): ?bool
    {
        return $this->presence_joint;
    }

    public function presence_retour_isolation(): ?bool
    {
        return $this->presence_retour_isolation;
    }

    public function type_porte(): TypePorte
    {
        return $this->type_porte;
    }

    public function type_pose(): TypePose
    {
        return $this->type_pose;
    }
}
