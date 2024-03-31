<?php

namespace App\Domain\PontThermique\Engine;

use App\Domain\PontThermique\PontThermique;
use App\Domain\PontThermique\Table\{Kpt, KptRepository};

/**
 * @see §3.4
 */
final class DeperditionPontThermique
{
    private PontThermique $input;
    private ?Kpt $table_k = null;

    public function __construct(private KptRepository $table_k_repository)
    {
    }

    /**
     * PT,pt - Déperditions par le pont thermique (W/K)
     * 
     * @see §3.4.2 - Pont thermique partiel
     */
    public function pt(): ?float
    {
        return $this->l() * $this->k() * $this->input->caracteristique()->pont_thermique_partiel ? 0.5 : 1;
    }

    /**
     * l,pt - Longueur du pont thermique (m)
     */
    public function l(): ?float
    {
        return $this->input->caracteristique()->longueur;
    }

    /**
     * k,pt - Valeur du pont thermique (W/(m.K))
     */
    public function k(): ?float
    {
        return $this->input->performance()->k_saisi ?? $this->table_k()?->k();
    }

    /**
     * Valeur de la table pont_thermique
     */
    public function table_k(): ?Kpt
    {
        return $this->table_k;
    }

    public function input(): PontThermique
    {
        return $this->input;
    }

    public function __invoke(PontThermique $input): self
    {
        $this->input = $input;

        $this->table_k = $this->table_k_repository->find(
            type_liaison: $input->type_liaison(),
            type_isolation_mur: $input->mur()?->type_isolation_defaut(),
            type_isolation_plancher: $input->plancher()?->type_isolation_defaut(),
            type_pose_ouverture: $input->ouverture()?->type_pose(),
            presence_retour_isolation: $input->ouverture()?->presence_retour_isolation(),
            largeur_dormant: $input->ouverture()?->largeur_dormant(),
        );

        return $this;
    }
}
