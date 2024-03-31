<?php

namespace App\Command\Simulation\Deperdition\Baie;

use App\Domain\Audit\Baie\Baie;
use App\Domain\Common\Enum\Baie\{TypeBaie, TypeFermeture};
use App\Domain\Common\Enum\Menuiserie\MateriauxMenuiserie;
use App\Domain\Common\Enum\Paroi\TypeAdjacence;
use App\Domain\Common\Enum\Vitrage\{InclinaisonVitrage, TypeGazLame, TypeVitrage};
use App\Domain\Common\Enum\Situation\ZoneClimatique;

final class DeperditionBaieCommand
{
    public function __construct(
        public readonly float $surface,
        public readonly ?float $ug_saisi,
        public readonly ?float $uw_saisi,
        public readonly ?float $ujn_saisi,
        public readonly ?float $epaisseur_lame,
        public readonly bool $vitrage_vir,
        public readonly TypeBaie $type_baie,
        public readonly MateriauxMenuiserie $type_materiaux_menuiserie,
        public readonly TypeVitrage $type_vitrage,
        public readonly TypeGazLame $type_gaz_lame,
        public readonly TypeFermeture $type_fermeture,
        public readonly InclinaisonVitrage $inclinaison_vitrage,
        public readonly ?float $surface_aiu,
        public readonly ?float $surface_aue,
        public readonly ?bool $isolation_aiu,
        public readonly ?bool $isolation_aue,
        public readonly bool $isolation,
        public readonly bool $adjacence_ets,
        public readonly array $orientation_ets_collection,
        public readonly ZoneClimatique $zone_climatique,
        public readonly TypeAdjacence $type_adjacence,
        public readonly ?DeperditionDoubleFenetreCommand $double_fenetre,
    ) {
    }

    public static function from(Baie $entity,): self
    {
        return new self(
            surface: $entity->surface(),
            ug_saisi: $entity->ug_saisi(),
            uw_saisi: $entity->uw_saisi(),
            ujn_saisi: $entity->ujn_saisi(),
            epaisseur_lame: $entity->epaisseur_lame(),
            vitrage_vir: $entity->vitrage_vir(),
            type_baie: $entity->type_baie(),
            type_materiaux_menuiserie: $entity->type_materiaux_menuiserie(),
            type_vitrage: $entity->type_vitrage(),
            type_gaz_lame: $entity->type_gaz_lame(),
            type_fermeture: $entity->type_fermeture(),
            inclinaison_vitrage: $entity->inclinaison_vitrage(),
            surface_aiu: $entity->lnc()?->surface_aiu(),
            surface_aue: $entity->lnc()?->surface_aue(),
            isolation_aiu: $entity->lnc()?->isolation_aiu(),
            isolation_aue: $entity->lnc()?->isolation_aue(),
            isolation: $entity->isolation(),
            adjacence_ets: $entity->adjacence_ets(),
            orientation_ets_collection: $entity->lnc()->ets_baie_collection()->orientations() ?? [],
            zone_climatique: $entity->enveloppe()->audit()->zone_climatique(),
            type_adjacence: $entity->type_adjacence(),
            double_fenetre: $entity->double_fenetre() ? DeperditionDoubleFenetreCommand::from($entity->double_fenetre()) : null,
        );
    }
}
