# Moteur de calcul de la Performance Conventionnelle des Logements (PCL)

> [!NOTE]
> Ce dépôt couvre uniquement les modèle de données du moteur de calcul et centralise les échanges relatifs à la
> méthode 3CL (améliorations, failles, interprétations...). La base de code de l'API fait l'objet d'un dépôt
> dédié accessible [ici](https://github.com/action-21/reno-audit-api).

> [!IMPORTANT]
> Ce projet est actuellement en cours de développement.

## Méthode de calcul

Nous proposons une extension de la méthode 3CL-DPE décrite dans le [wiki du projet](https://github.com/action-21/reno-audit/wiki) ainsi qu'une API publique afin d'isoler le recensement (la saisie des données d'entrée) et l'évaluation des performances (le moteur).

Les tables de valeurs conventionnelles sont regroupées dans le dossier /db aux formats csv et xml.

Ce dépôt vise également à recenser les incohérences et limites de la méthode 3CL afin de proposer des solutions validées par la communauté.

## Modèles de données

Le modèle de données actuellement disponible souffre d'un manque de lisibilité du fait de sa conception à des fins de contrôle de cohérence. Ce projet repart du besoin des usagers et propose un modèle de données orienté métier. La cohérence des informations renseignées est assurée par le moteur et non par le modèle.

Les modèles de données déduits de la méthode de calcul sont présentés dans le dossier /modele et /schemas (Open API).

Pour une meilleur visualisation des schémas de données, copier le schéma openapi.yaml dans [l'éditeur Swagger](https://editor-next.swagger.io/).

## Démo

Une démo s'appuyant sur la base de données des [DPE Logements existants](https://www.data.gouv.fr/fr/datasets/dpe-logements-existants-depuis-juillet-2021/) sera publiée sur le site du projet.

## Contact

[Adrien Rosi Dit Rozzi](https://www.linkedin.com/in/adrienrosi/)

## Contribuer

N'hésitez pas à échanger en créant de nouvelles [discussions](./discussions).
