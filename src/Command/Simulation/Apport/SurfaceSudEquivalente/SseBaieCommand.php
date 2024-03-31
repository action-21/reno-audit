<?php

namespace App\Command\Simulation\Apport\SurfaceSudEquivalente;

use App\Domain\Audit\Baie\{Baie, MasqueProche};
use App\Domain\Audit\Masque\MasqueLointain;
use App\Domain\Common\Enum\Baie\TypeBaie;
use App\Domain\Common\Enum\Menuiserie\{MateriauxMenuiserie, TypePose};
use App\Domain\Common\Enum\Paroi\Orientation;
use App\Domain\Common\Enum\Situation\ZoneClimatique;
use App\Domain\Common\Enum\Vitrage\{InclinaisonVitrage, TypeGazLame, TypeVitrage};

final class SseBaieCommand
{
    public function __construct(
        public readonly float $surface,
        public readonly ?float $sw_saisi,
        public readonly bool $vitrage_vir,
        public readonly ZoneClimatique $zone_climatique,
        public readonly Orientation $orientation,
        public readonly TypeBaie $type_baie,
        public readonly TypePose $type_pose,
        public readonly MateriauxMenuiserie $type_materiaux_menuiserie,
        public readonly TypeVitrage $type_vitrage,
        public readonly TypeGazLame $type_gaz_lame,
        public readonly InclinaisonVitrage $inclinaison_vitrage,
        public readonly ?SseDoubleFenetreCommand $double_fenetre,
        public readonly ?SseEtsCommand $ets,
        public readonly array $masque_proche_collection,
        public readonly array $masque_lointain_collection,
    ) {
    }

    public static function from(Baie $entity,): self
    {
        return new self(
            surface: $entity->surface(),
            sw_saisi: $entity->sw_saisi(),
            vitrage_vir: $entity->vitrage_vir(),
            zone_climatique: $entity->enveloppe()->audit()->zone_climatique(),
            orientation: $entity->orientation(),
            type_baie: $entity->type_baie(),
            type_pose: $entity->type_pose(),
            type_materiaux_menuiserie: $entity->type_materiaux_menuiserie(),
            type_vitrage: $entity->type_vitrage(),
            type_gaz_lame: $entity->type_gaz_lame(),
            inclinaison_vitrage: $entity->inclinaison_vitrage(),
            double_fenetre: $entity->double_fenetre() ? SseDoubleFenetreCommand::from($entity->double_fenetre()) : null,
            ets: $entity->lnc()?->ets() ? SseEtsCommand::from($entity->lnc()) : null,
            masque_proche_collection: \array_map(
                fn (MasqueProche $item): SseMasqueProcheCommand => SseMasqueProcheCommand::from($item),
                $entity->masque_proche_collection()->values(),
            ),
            masque_lointain_collection: \array_map(
                fn (MasqueLointain $item): SseMasqueLointainCommand => SseMasqueLointainCommand::from($item),
                $entity->masque_lointain_collection()->values(),
            ),
        );
    }
}
