<?php

namespace App\Repository;

use App\Config\Reference\{
    MethodeSaisieCaracteristiquesSysteme,
    PeriodeInstallationGenerateurChauffage,
    PeriodeInstallationGenerateurEcs,
    TypeGenerateurChauffage,
    TypeGenerateurEcs
};
use App\Config\Valeur\{
    TV_CoefficientMasqueLointainHomogene,
    TV_CoefficientMasqueLointainNonHomogene,
    TV_CoefficientMasqueProche,
    TV_CoefficientTransparenceEts,
    TV_PerteStockage,
    TV_RendementDistributionChauffage,
    TV_RendementDistributionEcs,
    TV_Uph
};
use App\Entity\Dpe;
use App\Entity\Enveloppe\{
    BaieVitree,
    DoubleFenetre,
    Ets,
    EtsBaie,
    Mur,
    PlancherBas,
    PlancherHaut,
    PontThermique,
    Porte
};
use App\Entity\Systeme\{
    Climatisation,
    EmetteurChauffage,
    GenerateurChauffage,
    GenerateurEcs,
    InstallationChauffage,
    InstallationEcs,
    Ventilation
};
use App\Entity\Situation\{Caracteristique, Meteo};
use App\Entity\Production\{PanneauxPhotovoltaique, ProductionElectriciteRenouvelable};
use App\Entity\Enveloppe;

class XMLDpeElement extends \SimpleXMLElement
{
    public function donnee_entree(): self
    {
        return $this->donnee_entree;
    }

    public function donnee_intermediaire(): self
    {
        return $this->donnee_intermediaire;
    }

    public function to_array(): array
    {
        return json_decode(\json_encode($this), true);
    }

    public function get(string $propery): ?self
    {
        return (string) $this->{$propery} ? $this->{$propery} : null;
    }

    public function merge_data(string $class, string $method = 'from'): array
    {
        $keys = \array_column((new \ReflectionMethod($class, $method))->getParameters(), 'name');
        $keys = \array_fill_keys($keys, null);

        return \array_replace($keys, array_intersect_key($this->to_array(), $keys));
    }

    public function normalize(): array
    {
        $scope = $this->get('logement') ?? $this->get('logement_neuf');

        $data = $this->administrarif->merge_data(Dpe::class);
        $data['logement'] = $scope?->logement();
        $data['descriptif_simplifie_collection'] = [];
        $data['descriptif_enr_collection'] = [];
        $data['fiche_technique_collection'] = [];
        $data['justificatif_collection'] = [];

        return [
            'logement' => $scope?->logement()
        ];
    }

    /**
     * * dpe/logement
     * * dpe/logement_neuf
     */
    public function logement(): array
    {
        return [
            'caracteristique_generale' => $this?->get('caracteristique_generale')?->caracteristique_generale(),
            'meteo' => $this?->get('meteo')?->meteo(),
            'enveloppe' => $this?->get('enveloppe')?->enveloppe(),
            'production_elec_enr' => $this?->get('production_elec_enr')?->production_elec_enr(),
            'ventilation_collection' => $this->ventilation_collection(),
            'climatisation_collection' => $this->climatisation_collection(),
            'installation_chauffage_collection' => $this->installation_chauffage_collection(),
            'installation_ecs_collection' => $this->installation_ecs_collection()
        ];
    }

    /**
     * * dpe/logement/caracteristique_generale
     * * dpe/logement_neuf/caracteristique_generale
     */
    public function caracteristique_generale(): array
    {
        return $this->merge_data(Caracteristique::class);
    }

    /**
     * * dpe/logement/meteo
     * * dpe/logement_neuf/meteo
     */
    public function meteo(): array
    {
        return $this->merge_data(Meteo::class);
    }

    /**
     * * dpe/logement/enveloppe
     * * dpe/logement_neuf/enveloppe
     */
    public function enveloppe(): array
    {
        return [
            ...(array) $this->get('inertie')?->merge_data(Enveloppe::class),
            ...['mur_collection' => $this->mur_collection()],
            ...['plancher_haut_collection' => $this->plancher_haut_collection()],
            ...['plancher_haut_collection' => $this->plancher_haut_collection()],
            ...['plancher_bas_collection' => $this->plancher_bas_collection()],
            ...['baie_vitree_collection' => $this->baie_vitree_collection()],
            ...['porte_collection' => $this->porte_collection()],
            ...['ets_collection' => $this->ets_collection()],
            ...['pont_thermique_collection' => $this->pont_thermique_collection()]
        ];
    }

    /**
     * * dpe/logement/enveloppe/mur_collection/mur/donnee_entree
     * * dpe/logement_neuf/enveloppe/mur_collection/mur/donnee_entree
     */
    public function mur_collection(): array
    {
        return \array_map(
            fn (XMLDpeElement $row): array => $row->merge_data(Mur::class),
            $this->xpath('//mur/donnee_entree')
        );
    }

    /**
     * * dpe/logement/enveloppe/plancher_haut_collection/plancher_haut/donnee_entree
     * * dpe/logement_neuf/enveloppe/plancher_haut_collection/plancher_haut/donnee_entree
     */
    public function plancher_haut_collection(): array
    {
        return \array_map(
            function (XMLDpeElement $row): array {
                $tv_uph = ($id = (string) $row->tv_uph_id) ? TV_Uph::find((int) $id) : null;

                return [
                    ...$row->merge_data(PlancherHaut::class),
                    ...['enum_type_toiture_id' => $tv_uph?->enum_type_toiture_defaut()?->id()]
                ];
            },
            $this->xpath('//plancher_haut/donnee_entree')
        );
    }

    /**
     * * dpe/logement/enveloppe/plancher_bas_collection/plancher_bas/donnee_entree
     * * dpe/logement_neuf/enveloppe/plancher_bas_collection/plancher_bas/donnee_entree
     */
    public function plancher_bas_collection(): array
    {
        return \array_map(
            fn (XMLDpeElement $row): array => $row->merge_data(PlancherBas::class),
            $this->xpath('//plancher_bas/donnee_entree')
        );
    }

    /**
     * * dpe/logement/enveloppe/baie_vitree_collection/baie_vitree/donnee_entree
     * * dpe/logement_neuf/enveloppe/baie_vitree_collection/baie_vitree/donnee_entree
     */
    public function baie_vitree_collection(): array
    {
        return \array_map(
            function (XMLDpeElement $row): array {
                return [
                    ...$row->merge_data(BaieVitree::class),
                    ...['double_fenetre' => $row->get('baie_vitree_double_fenetre')?->double_fenetre()],
                    ...['masque_lointain_homogene' => $row->get('tv_coef_masque_lointain_homogene_id')?->masque_lointain_homogene()],
                    ...['masque_proche_collection' => $row->masque_proche_collection()],
                    ...['masque_lointain_non_homogene_collection' => $row->masque_lointain_non_homogene_collection()]
                ];
            },
            $this->xpath('//baie_vitree/donnee_entree')
        );
    }

    /**
     * * dpe/logement/enveloppe/baie_vitree_collection/baie_vitree/donnee_entree/double_fenetre
     * * dpe/logement_neuf/enveloppe/baie_vitree_collection/baie_vitree/donnee_entree/double_fenetre
     */
    public function double_fenetre(): array
    {
        return $this->merge_data(DoubleFenetre::class);
    }

    /**
     * * dpe/logement/enveloppe/baie_vitree_collection/baie_vitree/donnee_entree
     * * dpe/logement_neuf/enveloppe/baie_vitree_collection/baie_vitree/donnee_entree
     */
    public function masque_proche_collection(): array
    {
        $tv_coef_masque_proche = TV_CoefficientMasqueProche::tryFrom((int) $this->tv_coef_masque_proche_id);

        return $tv_coef_masque_proche ? [[
            'avancee' => $tv_coef_masque_proche->avancee_defaut(),
            'enum_type_masque_proche_id' => $tv_coef_masque_proche->enum_type_masque_proche_defaut()?->value
        ]] : [];
    }

    /**
     * * dpe/logement/enveloppe/baie_vitree_collection/baie_vitree/donnee_entree/tv_coef_masque_lointain_homogene_id
     * * dpe/logement_neuf/enveloppe/baie_vitree_collection/baie_vitree/donnee_entree/tv_coef_masque_lointain_homogene_id
     */
    public function masque_lointain_homogene(): array
    {
        $tv_coef_masque_lointain_homogene = TV_CoefficientMasqueLointainHomogene::tryFrom((int) $this);

        return ['hauteur_alpha' => $tv_coef_masque_lointain_homogene->hauteur_alpha_defaut()];
    }

    /**
     * * dpe/logement/enveloppe/baie_vitree_collection/baie_vitree/donnee_entree
     * * dpe/logement_neuf/enveloppe/baie_vitree_collection/baie_vitree/donnee_entree
     */
    public function masque_lointain_non_homogene_collection(): array
    {
        return \array_map(
            function (XMLDpeElement $row): array {
                $tv_coef_masque_lointain_non_homogene = TV_CoefficientMasqueLointainNonHomogene::tryFrom((int) $row->tv_coef_masque_lointain_non_homogene_id);

                return [
                    'hauteur_alpha' => $tv_coef_masque_lointain_non_homogene?->hauteur_alpha_defaut(),
                    'enum_secteur_masque_id' => $tv_coef_masque_lointain_non_homogene?->enum_secteur_masque_defaut()?->id()
                ];
            },
            $this->xpath('masque_lointain_non_homogene_collection/masque_lointain_non_homogene')
        );
    }

    /**
     * * dpe/logement/enveloppe/porte_collection/porte/donnee_entree
     * * dpe/logement_neuf/enveloppe/porte_collection/porte/donnee_entree
     */
    public function porte_collection(): array
    {
        return \array_map(
            fn (XMLDpeElement $row): array => $row->merge_data(Porte::class),
            $this->xpath('//porte/donnee_entree')
        );
    }

    /**
     * * dpe/logement/enveloppe/ets_collection/ets
     * * dpe/logement_neuf/enveloppe/ets_collection/ets
     */
    public function ets_collection(): array
    {
        return \array_map(
            function (XMLDpeElement $row): array {
                $donne_entree = $row->donnee_entree();

                return [
                    ...$donne_entree->merge_data(Ets::class),
                    ...['ets_baie_collection' => $row->ets_baie_collection(TV_CoefficientTransparenceEts::tryFrom(
                        (int) $donne_entree->tv_coef_transparence_ets_id
                    ))]
                ];
            },
            $this->xpath('//ets_collection/ets')
        );
    }

    /**
     * * dpe/logement/enveloppe/ets_collection/ets/baie_ets_collection/baie_ets/donnee_entree
     * * dpe/logement_neuf/enveloppe/ets_collection/ets/baie_ets_collection/baie_ets/donnee_entree
     */
    public function ets_baie_collection(?TV_CoefficientTransparenceEts $tv_coefficient_transparence_ets = null): array
    {
        return \array_map(
            function (XMLDpeElement $row) use ($tv_coefficient_transparence_ets): array {
                $enum_type_materiaux_menuiserie = $tv_coefficient_transparence_ets?->enum_type_materiaux_menuiserie_defaut();
                $enum_type_vitrage = $tv_coefficient_transparence_ets?->enum_type_vitrage_defaut();

                return [
                    ...$row->merge_data(EtsBaie::class),
                    ...['vitrage_vir' => $tv_coefficient_transparence_ets?->vitrage_vir_defaut()],
                    ...['enum_type_materiaux_menuiserie_id' => $enum_type_materiaux_menuiserie?->id()],
                    ...['enum_type_vitrage_id' => $enum_type_vitrage?->id()]
                ];
            },
            $this->xpath('baie_ets_collection/baie_ets/donnee_entree')
        );
    }

    /**
     * * dpe/logement/enveloppe/pont_thermique_collection/pont_thermique/donnee_entree
     * * dpe/logement_neuf/enveloppe/pont_thermique_collection/pont_thermique/donnee_entree
     */
    public function pont_thermique_collection(): array
    {
        return \array_map(
            function (XMLDpeElement $row): array {
                $data = $row->merge_data(PontThermique::class);
                $data['pont_thermique_partiel'] = (float) $row->pourcentage_valeur_pont_thermique === 0.5;
                return $data;
            },
            $this->xpath('//pont_thermique/donnee_entree')
        );
    }

    /**
     * * dpe/logement/ventilation_collection/ventilation/donnee_entree
     * * dpe/logement_neuf/ventilation_collection/ventilation/donnee_entree
     */
    public function ventilation_collection(): array
    {
        return \array_map(
            fn (XMLDpeElement $row): array => $row->merge_data(Ventilation::class),
            $this->xpath('//ventilation_collection/ventilation/donnee_entree')
        );
    }

    /**
     * * dpe/logement/climatisation_collection/climatisation/donnee_entree
     * * dpe/logement_neuf/climatisation_collection/climatisation/donnee_entree
     */
    public function climatisation_collection(): array
    {
        return \array_map(
            fn (XMLDpeElement $row): array => $row->merge_data(Climatisation::class),
            $this->xpath('//climatisation_collection/climatisation/donnee_entree')
        );
    }

    /**
     * * dpe/logement/installation_chauffage_collection/installation_chauffage
     * * dpe/logement_neuf/installation_chauffage_collection/installation_chauffage
     */
    public function installation_chauffage_collection(): array
    {
        return \array_map(
            function (XMLDpeElement $row): array {
                return [
                    ...$row->donnee_entree()->merge_data(InstallationChauffage::class),
                    ...['emetteur_chauffage_collection' => $row->emetteur_chauffage_collection()],
                    ...['generateur_chauffage_collection' => $row->generateur_chauffage_collection()]
                ];
            },
            $this->xpath('//installation_chauffage_collection/installation_chauffage')
        );
    }

    /**
     * * dpe/logement/installation_chauffage_collection/installation_chauffage/emetteur_chauffage_collection/emetteur_chauffage/donnee_entree
     * * dpe/logement_neuf/installation_chauffage_collection/installation_chauffage/emetteur_chauffage_collection/emetteur_chauffage/donnee_entree
     */
    public function emetteur_chauffage_collection(): array
    {
        return \array_map(
            function (XMLDpeElement $row): array {
                $donne_entree = $row->donnee_entree();
                $data = $donne_entree->merge_data(EmetteurChauffage::class);
                $data['enum_type_distribution_id'] = TV_RendementDistributionChauffage::tryFrom(
                    (int) $donne_entree->tv_rendement_distribution_ch_id
                )?->enum_type_distribution_defaut()?->id();

                return $data;
            },
            $this->xpath('emetteur_chauffage_collection/emetteur_chauffage')
        );
    }

    /**
     * * dpe/logement/installation_chauffage_collection/installation_chauffage/generateur_chauffage_collection/generateur_chauffage/donnee_entree
     * * dpe/logement_neuf/installation_chauffage_collection/installation_chauffage/generateur_chauffage_collection/generateur_chauffage/donnee_entree
     */
    public function generateur_chauffage_collection(): array
    {
        return \array_map(
            function (XMLDpeElement $row): array {
                $donne_entree = $row->donnee_entree();
                $donnee_intermediaire = $row->donnee_intermediaire();

                $data = $donne_entree->merge_data(GenerateurChauffage::class, 'from');
                $data['pn_saisi'] = (float) $donnee_intermediaire->pn ?? null;

                $data['enum_type_generateur_ch_id'] = TypeGenerateurChauffage::defaut((int) $row->enum_type_generateur_ch_id)?->id();
                $data['enum_periode_installation_generateur_ch_id'] = PeriodeInstallationGenerateurChauffage::defaut((int) $row->enum_type_generateur_ch_id)?->id();

                if ($data['enum_methode_saisie_carac_sys_id'] == MethodeSaisieCaracteristiquesSysteme::ID_04->value) {
                    $data['rpn_saisi'] = (float) $donnee_intermediaire->rpn ?? null;
                    $data['rpint_saisi'] = (float) $donnee_intermediaire->rpint ?? null;
                    $data['qp0_saisi'] = (float) $donnee_intermediaire->qp0 ?? null;
                    $data['rpn_saisi'] = (float) $donnee_intermediaire->rpn ?? null;
                }
                if ($data['enum_methode_saisie_carac_sys_id'] == MethodeSaisieCaracteristiquesSysteme::ID_06->value) {
                    $data['scop_saisi'] = (float) $donnee_intermediaire->scop ?? null;
                }
                return $data;
            },
            $this->xpath('generateur_chauffage_collection/generateur_chauffage')
        );
    }

    /**
     * * dpe/logement/installation_ecs_collection/installation_ecs
     * * dpe/logement_neuf/installation_ecs_collection/installation_ecs
     */
    public function installation_ecs_collection(): array
    {
        return \array_map(
            function (XMLDpeElement $row): array {
                $donne_entree = $row->donnee_entree();
                $tv_rendement_distribution_ecs = TV_RendementDistributionEcs::tryFrom((int) $donne_entree->tv_rendement_distribution_ecs_id);

                return [
                    ...$row->donnee_entree()->merge_data(InstallationEcs::class),
                    ...['pieces_contigues' => $tv_rendement_distribution_ecs?->pieces_alimentees_contigues_defaut()],
                    ...['generateur_ecs_collection' => $row->generateur_ecs_collection()]
                ];
            },
            $this->xpath('//installation_ecs_collection/installation_ecs')
        );
    }

    /**
     * * dpe/logement/installation_ecs_collection/installation_ecs/generateur_ecs_collection/generateur_ecs/donnee_entree
     * * dpe/logement_neuf/installation_ecs_collection/installation_ecs/generateur_ecs_collection/generateur_ecs/donnee_entree
     */
    public function generateur_ecs_collection(): array
    {
        return \array_map(
            function (XMLDpeElement $row): array {
                $donne_entree = $row->donnee_entree();
                $donnee_intermediaire = $row->donnee_intermediaire();

                $data = $donne_entree->merge_data(GenerateurEcs::class, 'from');
                $data['pn_saisi'] = (float) $donnee_intermediaire->pn ?? null;
                $data['enum_type_generateur_ecs_id'] = TypeGenerateurEcs::defaut((int) $donne_entree->enum_type_generateur_ecs_id)?->id();
                $data['enum_periode_installation_generateur_ecs_id'] = PeriodeInstallationGenerateurEcs::defaut((int) $donne_entree->enum_type_generateur_ecs_id)?->id();

                // Type de ballon électrique pour les chaudières électriques
                if ($data['enum_type_generateur_ecs_id'] === TypeGenerateurEcs::ID_44) {
                    $tv_pertes_stockage = TV_PerteStockage::tryFrom((int) $donne_entree->tv_pertes_stockage_id);
                    $data['enum_type_ballon_electrique_id'] = $tv_pertes_stockage?->type_ballon_electrique_defaut()?->value;
                }

                if ($data['enum_methode_saisie_carac_sys_id'] == MethodeSaisieCaracteristiquesSysteme::ID_04->value) {
                    $data['rpn_saisi'] = (float) $donnee_intermediaire->rpn ?? null;
                    $data['rpint_saisi'] = (float) $donnee_intermediaire->rpint ?? null;
                    $data['qp0_saisi'] = (float) $donnee_intermediaire->qp0 ?? null;
                    $data['rpn_saisi'] = (float) $donnee_intermediaire->rpn ?? null;
                }
                if ($data['enum_methode_saisie_carac_sys_id'] == MethodeSaisieCaracteristiquesSysteme::ID_06->value) {
                    $data['cop_saisi'] = (float) $donnee_intermediaire->scop ?? null;
                }
                return $data;
            },
            $this->xpath('generateur_ecs_collection/generateur_ecs')
        );
    }

    /**
     * * dpe/logement/production_elec_enr
     * * dpe/logement_neuf/production_elec_enr
     */
    public function production_elec_enr(): array
    {
        return [
            ...$this->donnee_entree()->merge_data(ProductionElectriciteRenouvelable::class),
            ...['panneaux_pv_collection' => $this->panneaux_pv_collection()]
        ];
    }

    /**
     * * dpe/logement/production_elec_enr/panneaux_pv_collection/panneaux_pv
     * * dpe/logement_neuf/production_elec_enr/panneaux_pv_collection/panneaux_pv
     */
    public function panneaux_pv_collection(): array
    {
        return \array_map(
            fn (XMLDpeElement $row): array => $row->merge_data(PanneauxPhotovoltaique::class),
            $this->xpath('//panneaux_pv_collection/panneaux_pv')
        );
    }
}
