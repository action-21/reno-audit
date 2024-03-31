# Murs de refend

La saisie des murs de refend est requise pour la détermination de l'inertie du bâtiment ainsi que pour la compilation des métrés, notament la correction des surfaces déperditives de l'épaisseur des murs de refend.

La saisie d'un mur de refend est effectuée à la maille du `niveau` de bâtiment.

Ne sont considérés que les murs de refend lourds séparant deux espaces chauffés.

## Données d'entrée

| variable | type | description | couverture_opendata |
|:--------:|:----:|:-----------:|:-------------------:|
| niveau | object | Niveau parent | Non |
| description | string | Description libre du refend | Non |
| epaisseur | float | Epaisseur du mur de refend en mm | Non |

### Depuis l'opendata

Le modèle de données opendata ne permet pas d'identifier les murs de refend.
