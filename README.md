# Moteur de calcul de la Performance Conventionnelle des Logements (PCL)

> [!NOTE]
> Ce dépôt couvre uniquement les modèle de données du moteur de calcul et centralise les échanges relatifs à la
> méthode 3CL (améliorations, failles, interprétations...). La base de code de l'API fait l'objet d'un dépôt
> dédié accessible [ici](https://github.com/action-21/reno-audit-api).

> [!IMPORTANT]
> Ce projet est actuellement en cours de développement.

## Présentation

Ce projet poursuit deux objectifs qui s'inscrivent dans la stratégie nationale de rénovation énergétique des bâtiments :

**1. Mettre à la disposition de tous les acteurs un moteur d'évaluation des performances énergétiques d'un bâtiment ou d'un logement.**

Deux audits réalisés pour un même logement avec une fiabilité des données d'entrée identiques peuvent aboutir à des résultats différents. Un moteur de calcul commun et transparent est la garantie de fournir une information fiable et cohérente à tous les usagers et acteurs de la filière.

**2. Améliorer la qualité des données relatives à la performance du parc de bâtiments.**

Le modèle de données actuellement disponible souffre d'un manque de lisibilité du fait de sa conception à des fins de contrôle de cohérence. Ce projet repart du besoin des usagers et propose un modèle de données orienté métier. La cohérence des informations renseignées est assurée par le moteur et non par le modèle.

```
<mur>
    <donnee_entree>
        <description>Mur en blocs de béton creux Ep &lt;=20cm avec isolant (ITI+ITR) Ep=10 cm </description>
        <reference>M01O01</reference>
        <tv_coef_reduction_deperdition_id>1</tv_coef_reduction_deperdition_id>
        <enum_type_adjacence_id>1</enum_type_adjacence_id>
        <enum_orientation_id>1</enum_orientation_id>
        <surface_paroi_totale>34.6800</surface_paroi_totale>
        <surface_paroi_opaque>34.6800</surface_paroi_opaque>
        <tv_umur0_id>78</tv_umur0_id>
        <epaisseur_structure>20.00</epaisseur_structure>
        <enum_materiaux_structure_mur_id>12</enum_materiaux_structure_mur_id>
        <enum_methode_saisie_u0_id>2</enum_methode_saisie_u0_id>
        <enduit_isolant_paroi_ancienne>0</enduit_isolant_paroi_ancienne>
        <enum_type_doublage_id>2</enum_type_doublage_id>
        <enum_type_isolation_id>7</enum_type_isolation_id>
        <enum_periode_isolation_id>5</enum_periode_isolation_id>
        <epaisseur_isolation>10.00</epaisseur_isolation>
        <enum_methode_saisie_u_id>3</enum_methode_saisie_u_id>
    </donnee_entree>
    <donnee_intermediaire>
        <b>1.000</b>
        <umur>0.3448</umur>
        <umur0>2.5000</umur0>
    </donnee_intermediaire>
</mur>
```

Devient

```
{
  "description": "Mur en briques pleines simples avec doublage rapporté de nature indeterminée",
  "surface": 100,
  "surface_deperditive": 100,
  "type": "Murs en briques pleines simples",
  "type_doublage": "Doublage rapporté de nature indeterminée",
  "epaisseur": 100,
  "presence_enduit_isolant": true,
  "paroi_ancienne": true,
  "inertie": "Lourde",
  "annee_construction": 2014,
  "annee_renovation": null,
  "u0": null,
  "u": null,
  "position": {
    "mitoyennete": "Extérieur",
    "orientation": 90,
    "local_non_chauffe_id": null
  },
  "isolation": {
    "type_isolation": "Isolation thermique par l'intérieur",
    "annee_isolation": 2014,
    "epaisseur_isolation": 50,
    "resistance_thermique_isolation": null
  },
  "performance": {
    "u": 0.2,
    "b": 1,
    "deperdition": 80.5,
    "etat": "Insuffisant"
  }
}
```

## PCL vs 3CL

1. La méthode PCL est une **extension de la méthode 3CL** dans le sens ou elle est une implémentation de l'arrêté du 8 octobre 2021 modifiant la méthode de calcul et les modalités d’établissement du diagnostic de performance énergétique.

2. Les modèles de données utilisées par le PCL s'émancipent des modèles DPE-Audit édités par le l'Observatoire DPE. Si un travail de couplage a été réalisé, une partie des données modélisées par le PCL n'ont pas d'équivalence dans les modèles DPE-Audit et devront donc être déduites ou resaisies.

3. La PCL fait le choix de mettre l'accent sur la notion de **performance conventionnelle** et non de **consommation conventionnelle**. Cette dernière est trompeuse car par son caractère conventionnel, la méthode de calcul accouche d'un indicateur de comparaison _toutes choses égales par ailleurs_ qui ne permet pas d'anticiper les consommations réelles des occupants.

## Compatibilité open data

85% des DPE / audits réglementaires de l'open data de l'ADEME peuvent être reconstitués.

| Version modèle DPE-Audit |                                                                                                                                         Description                                                                                                                                          | Compatibilité |
| :----------------------: | :------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------: | :-----------: |
|            v1            | version allégée du modèle de donnée DPE sans le détail de la modélisation enveloppe et système pour le DPE logement existant et le DPE logement neuf. Ce type de DPE a été mis en place de manière transitoire au démarrage du nouvel observatoire. Les logiciels sont en cours d'évaluation |      ❌       |
|           v1.1           | version allégée du modèle de donnée DPE sans le détail de la modélisation enveloppe et système pour le DPE logement existant et le DPE logement neuf. Ce type de DPE a été mis en place de manière transitoire au démarrage du nouvel observatoire. Les logiciels sont en cours d'évaluation |      ❌       |
|            v2            |                                                             version complète du modèle DPE pour la partie logement existant. La partie de description de l'enveloppe et des systèmes est toujours optionnelle pour le DPE neuf.                                                              |      ❌       |
|           v2.1           |                          version complète du modèle DPE pour la partie logement existant. La partie de description de l'enveloppe et des systèmes est toujours optionnelle pour le DPE neuf. Les logiciels sont évalués. Les contrôles de cohérences sont effectués                          |      ✔️       |
|           v2.2           |                                                                      version du modèle DPE qui introduit de nouveaux champs obligatoires pour assurer une compatibilité de reprise des xml DPE pour réaliser un audit.                                                                       |      ✔️       |
|           v2.3           |                                                                          des corrections sont apportées pour rendre le modèle de DPE plus complet pour des usages de réimport de xml ADEME dans les logiciels DPE.                                                                           |      ✔️       |
|           v2.4           |                                                                                                                                              -                                                                                                                                               |      ✔️       |

## Sources

### Méthode

- [Arrêté du 8 octobre 2021 modifiant la méthode de calcul et les modalités d'établissement du diagnostic de performance énergétique](https://www.legifrance.gouv.fr/jorf/id/JORFTEXT000044202205)

  - [Notice explicative](https://www.ecologie.gouv.fr/sites/default/files/documents/notice_DPE.pdf)
  - [Guide à l'attention des diagnostiqueurs](https://rt-re-batiment.developpement-durable.gouv.fr/IMG/pdf/v3_guidedpe.pdf)

- [Arrêté du 31 mars 2021 relatif au diagnostic de performance énergétique pour les bâtiments ou parties de bâtiments à usage d'habitation en France métropolitaine](https://www.legifrance.gouv.fr/jorf/id/JORFTEXT000043353335)

#### Arrêtés réseau de chaleur

- [Arrêté du 5 juillet 2024 modifiant l'arrêté du 15 septembre 2006 relatif au diagnostic de performance énergétique pour les bâtiments ou parties de bâtiment autres que d'habitation existants proposés à la vente en France métropolitaine](https://www.legifrance.gouv.fr/jorf/id/JORFTEXT000049925781)

- [Arrêté du 16 mars 2023 modifiant l'arrêté du 15 septembre 2006 relatif au diagnostic de performance énergétique pour les bâtiments ou parties de bâtiment autres que d'habitation existants proposés à la vente en France métropolitaine](https://www.legifrance.gouv.fr/jorf/id/JORFTEXT000047329716)

- [Arrêté du 21 octobre 2021 modifiant l'arrêté du 15 septembre 2006 relatif au diagnostic de performance énergétique pour les bâtiments existants proposés à la vente en France métropolitaine](https://www.legifrance.gouv.fr/jorf/id/JORFTEXT000044336238)

### Modèle

- [Modèle Dpe Audit](https://gitlab.com/observatoire-dpe/observatoire-dpe)

- [Observatoire Dpe Audit](https://observatoire-dpe-audit.ademe.fr/)

- [DPE Logements existants (depuis juillet 2021)](https://data.ademe.fr/datasets/dpe-v2-logements-existants)

- [Audits énergétiques logement existants (depuis le 1 septembre 2023)](https://data.ademe.fr/datasets/audit-opendata)

## Modèles de données

Les modèles de données déduits de la méthode de calcul sont présentés dans le dossier /modele et /schemas (Open API).

Pour une meilleur visualisation des schémas de données, copier le schéma openapi.yaml dans [l'éditeur Swagger](https://editor-next.swagger.io/).

## Bases de données

Les données statiques (réseaux de chaleurs, valeurs conventionnelles) sont regroupées dans le dossier /db aux formats csv et xml.

## Améliorations

Ce dépôt vise également à recenser les défauts de la méthode 3CL et de proposer des solutions validées par la communauté.

## Wiki

Un wiki de la méthode PCL est disponible sur ce dépot.

## Démo

Une démo s'appuyant sur la base de données des [DPE Logements existants](https://www.data.gouv.fr/fr/datasets/dpe-logements-existants-depuis-juillet-2021/) sera publiée sur le site du projet.

## Contact

[Adrien Rosi Dit Rozzi](https://www.linkedin.com/in/adrienrosi/)

## Contribuer

N'hésitez pas à échanger en créant de nouvelles [discussions](./discussions).
