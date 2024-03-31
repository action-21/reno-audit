# @renolab/audit

Ce projet a pour objectif de proposer un outil d'évaluation des performances énergétiques conventionnelles d'un logement avant et après réalisation d'un scénario de rénovation sur la base d'un audit énergétique existant référencé sur l'opendata de l'ADEME.

## Synthèse

### Objectifs

- 🎯 Évaluer l'impacte d'un scénario de travaux sur un audit réglementaire existant
- 🎯 Proposer un moteur de calcul 3CL-DPE en open source

### Usages

- 👉 Récupération d'un audit/DPE existant
- 👉 Simulation 3CL-DPE d'un audit/DPE existant
- 👉 Simulation 3CL-DPE d'un scénario de travaux sur la base d'un audit/DPE existant

### Livrables

- 🛠️ Modèle de données compatibles avec l'observatoire DPE
- 🛠️ Moteur 3CL-DPE complet
- 🛠️ API dédiée pour interroger la base des audits et simuler un scénario de travaux
- 🛠️ Documentation métier

### Budget

**⚠️ Ce projet n'est pas financé pour le moment et est porté bénévolement**

## Motivations

- La méthode de calcul 3CL-DPE utilisée pour l’édition des Diagnostics de Performance Energétique et Audits réglementaires regroupe des centaines de données permettant de décrire les caractéristiques d’un bâtiment ainsi que son comportement énergétique.

- Les données issues du DPE sont essentiellement exploitées à des fins de comparaison immobilière sur la base de l’étiquette énergétique (de A pour un logement très performant à G pour une passoire thermique).

- La base DPE mise à disposition par l’ADEME en open data couvre plus de 4.5 M de logements dont 1.6 M de logements individuels.

- La donnée DPE pourrait être un vecteur d’information pour aider les ménages à mieux appréhender la performance énergétique d’un logement,

## Feuille de route

**🚧 Projet en cours de développement**

1. Modélisation de la méthode 3CL-DPE
2. Modélisation des tables de valeurs et d'énumérations
3. Développement du moteur 3CL-DPE
4. Développement et déploiement des APIs
