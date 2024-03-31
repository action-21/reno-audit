<?php

namespace App\Command\Simulation\Deperdition\PontThermique;

use App\Domain\Audit\PontThermique\PontThermique;
use App\Domain\Common\Enum\Isolation\TypeIsolation;
use App\Domain\Common\Enum\Menuiserie\TypePose;
use App\Domain\Common\Enum\PontThermique\TypeLiaison;

final class DeperditionPontThermiqueCommand
{
    public function __construct(
        public readonly float $longueur,
        public readonly ?float $k_saisi,
        public readonly ?bool $pont_thermique_partiel,
        public readonly ?float $largeur_dormant,
        public readonly ?bool $presence_retour_isolation,
        public readonly TypeLiaison $type_liaison,
        public readonly ?TypeIsolation $type_isolation_mur,
        public readonly ?TypeIsolation $type_isolation_plancher,
        public readonly ?TypePose $type_pose_ouverture,
    ) {
    }

    public static function from(PontThermique $entity): self
    {
        return new self(
            longueur: $entity->longueur(),
            k_saisi: $entity->k_saisi(),
            pont_thermique_partiel: $entity->pont_thermique_partiel(),
            largeur_dormant: $entity->ouverture()?->largeur_dormant(),
            presence_retour_isolation: $entity->ouverture()?->presence_retour_isolation(),
            type_liaison: $entity->type_liaison(),
            type_isolation_mur: $entity->mur()?->type_isolation(),
            type_isolation_plancher: $entity->plancher()?->type_isolation(),
            type_pose_ouverture: $entity->ouverture()?->type_pose(),
        );
    }
}
