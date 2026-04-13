#  ProjectBackendIAGI - Plateforme de Recrutement

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

## 📌 Présentation du Projet
Ce projet est une API Backend développée avec **Laravel 11** pour la gestion d'offres d'emploi. Cette première phase concerne la modélisation des données et l'initialisation de l'environnement de développement.

---

##  Partie 1 : Modélisation et Base de Données (Darid Bakr)

L'objectif de cette étape était de construire une base de données solide et fonctionnelle, prête à accueillir l'authentification et les fonctionnalités métier.

### 🏗️ Structure de la Base de Données
J'ai creer le repetoire ProjectLaravelIAGI </br>
![Laravel](docs/screenshots/3.png) </br>
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

![Depot](docs/screenshots/6.png)
</br>

2. **Installation des dépendances :** :  
Afin d'ignorer les contraintes de version si PHP < 8.4
![Ignorer](docs/screenshots/ignorephp.png)
</br>

3. **Creation de la branche de Travail** :  
![Parition](docs/screenshots/partie1.png)
</br>

4. **Table User** :  
Modification dans database > migrations </br>
![usertable](docs/screenshots/usertable.png)
</br>


5. **Créer les nouveaux modèles migrations et préparer les Factories** :  
![cmd1](docs/screenshots/cmd1.png)</br>
![cmd2](docs/screenshots/cmd2.png)

</br>


6. **Configurer DatabaseSeeder** :  </br>
Dans database/seeders/DatabaseSeeder.php </br>
![databaseeder](docs/screenshots/databaseeder.png)
</br>


7. **Modifier les modèles** : </br>
On modifier les modeles Offres, Profil, Competence et Candidature dans app/Models </br>
![Offre](docs/screenshots/offre.png)
</br>

![profil](docs/screenshots/profil.png)
</br>

![competence](docs/screenshots/competence.png)
</br>

![candidature](docs/screenshots/candidature.png)
</br>


8. **Générer des données pour la table profils** :  </br>
Dans le dossier database/factories/ </br>
![profilfactory](docs/screenshots/profilfactories.png)
</br>


9. **Générer les offres d'emploi (CDI, CDD, stage)** :  
![offrefactory](docs/screenshots/offrefactory.png)
</br>


10. **Pour la table competences** :  
![comp](docs/screenshots/comp.png)
</br>


11. **Code de la migration offre** :  </br>
Dans database/migrations/2026_04_13_195513_create_offres_table.php </br>
![off](docs/screenshots/off.png)
</br>


12. **Migration profile** :  
![p](docs/screenshots/p.png)
</br>

13. **Migration candidatures** :  
![c](docs/screenshots/c.png)
</br>

14. **Database seeding** :  
![d](docs/screenshots/d.png)
</br>