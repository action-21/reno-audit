
## Points de vigilance

### Traitement des cascades

La méthode 3CL-DPE couvre deux configurations en présence de générateurs à combustion :

- Présence de n générateur(s) indépendants
- Présence de deux générateurs en cascade sans priorité
- Présence de deux générateurs en cascade avec priorité

En l'absence de donées d'entrée permettant d'identifier avec certitude l'un des scénarios ci-dessus, le traitement décrit ci-après est appliqué :

En présence de N générateurs à combustion avec une donnée d'entrée priorite_generateur_cascade absente ou égale à NULL : la configuration **Présence de n générateur(s) indépendants** est retenue.

En présence de N générateurs à combustion avec une donnée d'entrée priorite_generateur_cascade égale à 0 (false) : la configuration **Présence de deux générateurs en cascade sans priorité** est retenue.

En présence de N générateurs à combustion avec une donnée d'entrée priorite_generateur_cascade absente égale à 1 (true) : la configuration **Présence de deux générateurs en cascade avec priorité** est retenue.
