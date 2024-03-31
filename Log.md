

## Ventilation

### Données d'entrée

La saisie des systèmes de ventilation se fait à la maille du logement, avec 1 logement = 1 ventilation. Dans le cas d'un DPE à l'immeuble, les systèmes de ventilation sont regroupés par type.



## Logement

### Hauteur sous plafond

La hauteur sous plafond moyenne exige a minima une saisie des niveaux du logement / de l'immeuble avec pour chaque niveau, sa surface habitable et sa hauteur sous plafonds moyenne.

L'opendata ne permettant pas d'identifier les caractéristiques des différents niveaux du logement / de l'immeuble, on considerera x niveaux de surface habitable shab et de hauteur sous plafond hsp avec :

- x = `nombre_niveau_logement` OU `nombre_niveau_immeuble`
- shab = `surface_habitable_logement` / `nombre_niveau_logement` OU `surface_habitable_immeuble` / `nombre_niveau_immeuble`
- hsp = hsp

## Enveloppe

### Parois anciennes lourdes

La propriété `batiment_materiaux_anciens` est déterminée à partir des données d'entrée des murs et de l'inertie générale de l'enveloppe. La donnée d'entrée correspondante est ignorée.

### Parois anciennes lourdes

La propriété `parois_anciennes_lourdes` est déterminée à partir des données d'entrée des murs. La donnée d'entrée correspondante est ignorée.

### Inertie

Le calcul de l'inertie exige a minima une saisie des niveaux du logement / de l'immeuble ainsi qu'une correspondante entre parois et niveaux.

L'opendata ne permettant pas d'identifier les caractéristiques des différents niveaux du logement / de l'immeuble, on renseignera la classe d'inertie de chaque niveau sur la base de la donnée d'entrée `enum_classe_inertie_id`.


### 6.3 Traitement des espaces tampons solarisés

> Dans le cas où les vitrages séparant l’espace tampon solarisé de l’extérieur sont hétérogènes, le coefficient T est celui du vitrage majoritaire. Dans le cas où aucun vitrage n’est majoritaire, le coefficient T est proratisé à la surface.

On évaluera le coefficient T à la maille de la baie séparant l'espace tampon solarisé de l'extérieur avant d'être proratisé à la surface.


## Ecs

### Générateur



Les périodes d'installation des générateurs d'ECS ont été regroupées par soucis de cohérence 
