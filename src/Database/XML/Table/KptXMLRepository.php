<?php

namespace App\Database\XML\Table;

use App\Domain\Common\Enum;
use App\Database\XML\{XMLElement, XMLRepository};
use App\Domain\Moteur3CL\Deperdition\PontThermique\Table\{Kpt, KptRepository};

class KptXMLRepository implements KptRepository
{
    use XMLRepository;

    public static function path(): string
    {
        return __DIR__ . '../../etc/tables/tv_kpt.xml';
    }

    public function find(
        Enum $type_liaison,
        ?Enum $type_isolation_mur,
        ?Enum $type_isolation_plancher,
        ?Enum $type_pose_ouverture,
        ?bool $presence_retour_isolation,
        ?int $largeur_dormant,
    ): ?Kpt {
        $largeur_dormant = $largeur_dormant <= 7.5 ? 5 : 10;

        $this->query = \sprintf('//row[enum_type_liaison_id = "%s"]', $type_liaison->id());
        $this->query .= \sprintf('[enum_type_isolation_mur_id = "" or enum_type_isolation_mur_id = "%s"]', $type_isolation_mur?->id());
        $this->query .= \sprintf('[enum_type_isolation_plancher_id = "" or enum_type_pose_id = "%s"]', $type_isolation_plancher?->id());
        $this->query .= \sprintf('[enum_type_pose_id = "" or enum_type_pose_id = "%s"]', $type_pose_ouverture?->id());
        $this->query .= \sprintf('[presence_retour_isolation = "" or presence_retour_isolation = "%s"]', null !== $presence_retour_isolation ? (int) $presence_retour_isolation : null);
        $this->query .= \sprintf('[largeur_dormant = "" or largeur_dormant = "%s"]', $largeur_dormant);

        return ($record = $this->getOne()) ? $this->to($record) : null;
    }

    protected function to(XMLElement $record): Kpt
    {
        return new Kpt(id: $record->id(), k: (float) $record->k,);
    }
}
