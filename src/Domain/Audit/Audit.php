<?php

namespace App\Domain\Audit;

use App\Domain\Audit\Enum\MethodeApplicationDpeLog;
use App\Domain\Common\Identifier\Uuid;
use App\Domain\Audit\Immeuble\Immeuble;
use App\Domain\Audit\ValueObject\{Auditeur, Proprietaire};
use App\Domain\Audit\Ventilation\{Ventilation, VentilationCollection};
use App\Domain\Batiment\Batiment;

final class Audit
{
    public function __construct(
        private readonly \Stringable $reference,
        private readonly \DateTimeImmutable $date_creation,
        private readonly MethodeApplicationDpeLog $methode_application,
        private ?Batiment $batiment,
        private ?Auditeur $auditeur,
        private ?Proprietaire $proprietaire,
    ) {
    }

    public static function create(
        MethodeApplicationDpeLog $methode_application,
        ?Auditeur $auditeur,
        ?Proprietaire $proprietaire,
    ): self {
        return new self(
            reference: Uuid::create(),
            date_creation: new \DateTimeImmutable(),
            methode_application: $methode_application,
            auditeur: $auditeur,
            proprietaire: $proprietaire,
            batiment: null,
        );
    }

    public function reference(): \Stringable
    {
        return $this->reference;
    }

    public function date_creation(): \DateTimeImmutable
    {
        return $this->date_creation;
    }

    public function methode_application(): MethodeApplicationDpeLog
    {
        return $this->methode_application;
    }

    public function batiment(): ?Batiment
    {
        return $this->batiment;
    }

    public function surface_habitable_moyenne(): float
    {
        return $this->logement_collection->surface_habitable_moyenne();
    }

    public function batiment_materiaux_anciens(): bool
    {
        return $this->logement_collection->batiment_materiaux_anciens();
    }

    public function parois_anciennes_lourdes(): bool
    {
        return $this->logement_collection->parois_anciennes_lourdes();
    }

    public function ventilation_collection(): VentilationCollection
    {
        return new VentilationCollection(\array_map(
            fn (Logement $item): Ventilation => $item->ventilation(),
            $this->logement_collection()->filter(fn (Logement $item): bool => null !== $item->ventilation())->values(),
        ));
    }
}
