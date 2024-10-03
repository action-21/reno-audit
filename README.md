# Méthode de calcul de la Performance Conventionnelle des Logements (PCL)

> [!IMPORTANT]
> Ce dépôt couvre uniquement les modèle de données du moteur de calcul et centralise les échanges relatifs à la 
> méthode 3CL (améliorations, failles, interprétations...). La base de code de l'API fait l'objet d'un dépôt 
> dédié accessible [ici](https://github.com/action-21/reno-audit-api).

## PCL vs 3CL

1. La méthode PCL est une **extension de la méthode 3CL** dans le sens ou elle est une implémentation de l'arrêté du 8 octobre 2021 modifiant la méthode de calcul et les modalités d’établissement du diagnostic de performance énergétique.

2. Les modèles de données utilisées par le PCL s'émancipent des modèles DPE-Audit édités par le l'Observatoire DPE. Si un travail de couplage a été réalisé, une partie des données modélisées par le PCL n'ont pas d'équivalence dans les modèles DPE-Audit et devront donc être déduites ou resaisies.

3. La PCL fait le choix de mettre l'accent sur la notion de **performance conventionnelle** et non de **consommation conventionnelle**. Cette dernière est trompeuse car par son caractère conventionnel, la méthode de calcul accouche d'un indicateur de comparaison *toutes choses égales par ailleurs* qui ne permet pas d'anticiper les consommations réelles des occupants.

## Modèles de données

Les modèles de données déduits de la méthode de calcul sont présentés dans le dossier /model. 

## Bases de données

Les données statiques (réseaux de chaleurs, valeurs conventionnelles) sont regroupées dans le dossier /db aux formats csv et xml.

## Améliorations

Ce dépôt vise également à recenser les défauts de la méthode 3CL et de proposer des solutions validées par la communauté.

## Wiki

Un wiki de la méthode PCL sera publié sur un site dédié.

## Démo

Une démo s'appuyant sur la base de données des [DPE Logements existants](https://www.data.gouv.fr/fr/datasets/dpe-logements-existants-depuis-juillet-2021/) sera publiée sur le site du projet.

## Roadmap

1. ~~Définition du projet~~
2. **Conception des modèles de données**
3. Site de présentation
4. Démo en ligne

## Contact

[Adrien Rosi Dit Rozzi](https://www.linkedin.com/in/adrienrosi/)

## Contribuer

N'hésitez pas à échanger en créant de nouvelles [discussions](./discussions).
