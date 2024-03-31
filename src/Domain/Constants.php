<?php

namespace App\Domain\Moteur3CL;

final class Constants
{
    /**
     * Lambda par défaut des murs isolés
     * 
     * @see §3.2.1
     */
    final public const LAMBDA_MUR_DEFAUT = 0.04;

    /**
     * Lambda par défaut des planchers bas isolés
     * 
     * @see §3.2.2
     */
    final public const LAMBDA_PLANCHER_BAS_DEFAUT = 0.042;

    /**
     * Lambda par défaut des planchers hauts isolés
     * 
     * @see §3.2.3
     */
    final public const LAMBDA_PLANCHER_HAUT_DEFAUT = 0.04;

    /**
     * Résistance additionnelle dûe à la présence d'un enduit sur une paroi ancienne
     * 
     * @see §3.2.1
     */
    final public const RESISTANCE_ENDUIT_PAROI_ANCIENNE = 0.7;

    /**
     * Puissance convenionnelle de chaleur par nombre d'adultes équivalents (W)
     * 
     * @see §11.1
     */
    final public const PUISSANCE_CHALEUR_NADEQ = 90;

    /**
     * Puissance conventionnelle de chaleur dégagée par l’ensemble des équipements en période d'occupation hors période de sommeil (W/m²)
     * 
     * @see §11.1
     */
    final public const PUISSANCE_CHALEUR_EQUIPEMENT_OCCUPATION = 5.7;

    /**
     * Puissance conventionnelle de chaleur dégagée par l’ensemble des équipements en période d'inoccupation (W/m²)
     * 
     * @see §11.1
     */
    final public const PUISSANCE_CHALEUR_EQUIPEMENT_INOCCUPATION = 1.1;

    /**
     * Puissance conventionnelle de chaleur dégagée par l’ensemble des équipements pendant le sommeil (W/m²)
     * 
     * @see §11.1
     */
    final public const PUISSANCE_CHALEUR_EQUIPEMENT_SOMMEIL = 1.1;

    /**
     * Nombre d'heures d'occupation conventionnel sur une semaine (h)
     * 
     * @see §11.1
     */
    final public const PERIODE_OCCUPATION_HEBDOMADAIRE = 76;

    /**
     * Nombre d'heures d'inoccupation conventionnel sur une semaine (h)
     * 
     * @see §11.1
     */
    final public const PERIODE_INOCCUPATION_HEBDOMADAIRE = 36;

    /**
     * Nombre d'heures de sommeil conventionnel sur une semaine (h)
     * 
     * @see §11.1
     */
    final public const PERIODE_SOMMEIL_HEBDOMADAIRE = 56;

    /**
     * Nombre annuel d’heures de fonctionnement de l’ECS (h)
     * 
     * @see §14.1
     */
    final public const PERIODE_FONCTIONNEMENT_ECS = 1790;
}
