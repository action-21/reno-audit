# Planchers intermédiaires

La saisie des planchers intermédiaires est requise pour la détermination de l'inertie du bâtiment ainsi que pour la détermination des métrés, notament la correction des surfaces déperditives des liaisons.

La saisie d'un plancher intermédiaire est effectuée à la maille du `niveau` de bâtiment.

Ne sont considérés que les plancers intermédiaires lourds séparant deux espaces chauffés.

## Données d'entrée

| variable | type | description | couverture_opendata |
|:--------:|:----:|:-----------:|:-------------------:|
| niveau | object | Niveau parent | Non |
| description | string | Description libre du refend | Non |
| surface | float | Suface totale du plancher intermédiaire en m² | Non |
| epaisseur | float | Epaisseur du mur de refend en mm | Non |
| type_plancher | enum | Type de plancher intermédiaire | Non |

### Depuis l'opendata

Le modèle de données opendata ne permet pas d'identifier les planchers intermédiaires.
