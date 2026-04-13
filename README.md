# 🚀 ProjectBackendIAGI - Plateforme de Recrutement

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

## 📌 Présentation du Projet
Ce projet est une API Backend développée avec **Laravel 11** pour la gestion d'offres d'emploi. Cette première phase concerne la modélisation des données et l'initialisation de l'environnement de développement.

---

## ✅ Partie 1 : Modélisation et Base de Données (Darid Bakr)

L'objectif de cette étape était de construire une base de données solide et fonctionnelle, prête à accueillir l'authentification et les fonctionnalités métier.

### 🏗️ Structure de la Base de Données
J'ai creer le repetoire ProjectLaravelIAGI
![Laravel](docs/screenshots/3.png)
![Fichier](docs/screenshots/5.png)

J'ai implémenté les migrations pour les entités suivantes, conformément au MLD :
- **Users** : Gestion des rôles (admin, recruteur, candidat).
- **Profils** : Détails des candidats (titre, bio, localisation, disponibilité).
- **Offres** : Annonces postées par les recruteurs (CDI, CDD, Stage).
- **Compétences** : Liste technique (Backend, Frontend, Design, etc.).
- **Candidatures** : Lien entre un candidat et une offre avec gestion de statut.
- **Profil_Competence** : Table pivot pour la relation Many-to-Many entre profils et compétences.

### 🧪 Seeding & Données de Test
La base est automatiquement pré-remplie avec les données suivantes :
- **2 Administrateurs**.
- **5 Recruteurs** (avec 2 à 3 offres chacun).
- **10 Candidats** (avec profil complet et compétences associées).

---

## 🛠️ Installation et Utilisation

Pour lancer le projet localement et vérifier la structure :

1. **Clonage du dépôt** :
   ```bash
   git clone [https://github.com/bdarid/ProjectBackendIAGI.git](https://github.com/bdarid/ProjectBackendIAGI.git)
   cd ProjectBackendIAGI