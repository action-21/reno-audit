<?php

namespace App\Domain\Paroi\ValueObject;

use App\Domain\Paroi\Enum\{MethodeSaisiePerformance, PeriodeIsolation, TypeIsolation};

final class PerformanceIsolation
{
    public function __construct(
        public readonly TypeIsolation $type_isolation,
        public readonly MethodeSaisiePerformance $methode_saisie,
        public readonly ?PeriodeIsolation $periode_isolation = null,
        public readonly ?float $epaisseur_isolation = null,
        public readonly ?float $resistance_isolation = null,
        public readonly ?float $u_saisi = null,
    ) {
    }

    private function check(): self
    {
        if (false === $this->type_isolation->est_isole() && $this->periode_isolation) {
            throw new \InvalidArgumentException('La période d\'isolation ne doit pas être renseignée pour une paroi non isolée');
        }
        if (false === $this->type_isolation->est_isole() && $this->epaisseur_isolation) {
            throw new \InvalidArgumentException('L\'épaisseur de l\'isolation ne doit pas être renseigné pour une paroi non isolée');
        }
        if (false === $this->type_isolation->est_isole() && $this->resistance_isolation) {
            throw new \InvalidArgumentException('La résistance thermique de l\'isolation ne doit pas être renseignée pour une paroi non isolée');
        }

        return $this;
    }

    public static function create_from_valeur_forfaitaire(
        TypeIsolation $type_isolation,
        ?PeriodeIsolation $periode_isolation,
    ): self {
        return (new self(
            type_isolation: $type_isolation,
            methode_saisie: MethodeSaisiePerformance::VALEUR_FORFAITAIRE,
            periode_isolation: $periode_isolation,
        ))->check();
    }

    public static function create_from_observation(
        TypeIsolation $type_isolation,
        ?float $epaisseur_isolation = null,
        ?float $resistance_isolation = null,
        ?PeriodeIsolation $periode_isolation = null,
    ) {
        return (new self(
            type_isolation: $type_isolation,
            methode_saisie: MethodeSaisiePerformance::MESURE_OBSERVATION,
            periode_isolation: $periode_isolation,
            epaisseur_isolation: $epaisseur_isolation,
            resistance_isolation: $resistance_isolation,
            u_saisi: null,
        ))->check();
    }

    public static function create_from_documents_justificatifs(
        float $u_saisi,
        TypeIsolation $type_isolation,
        ?PeriodeIsolation $periode_isolation = null,
        ?float $epaisseur_isolation = null,
        ?float $resistance_isolation = null,
    ): self {
        return (new self(
            type_isolation: $type_isolation,
            methode_saisie: MethodeSaisiePerformance::DOCUMENTS_JUSTIFICATIFS,
            periode_isolation: $periode_isolation,
            epaisseur_isolation: $epaisseur_isolation,
            resistance_isolation: $resistance_isolation,
            u_saisi: $u_saisi,
        ))->check();
    }

    public static function create_from_etude_reglementaire(
        float $u_saisi,
        TypeIsolation $type_isolation,
        ?PeriodeIsolation $periode_isolation = null,
        ?float $epaisseur_isolation = null,
        ?float $resistance_isolation = null,
    ): self {
        return (new self(
            type_isolation: $type_isolation,
            methode_saisie: MethodeSaisiePerformance::ETUDE_REGLEMENTAIRE,
            periode_isolation: $periode_isolation,
            epaisseur_isolation: $epaisseur_isolation,
            resistance_isolation: $resistance_isolation,
            u_saisi: $u_saisi,
        ))->check();
    }
}
