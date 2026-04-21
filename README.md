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

---

## 🔐 Partie 2 & 3 : Authentification JWT & Endpoints API 

Cette phase concerne la sécurisation de l'API avec **JWT** et la mise en place des routes **(CRUD)** pour les profils, les offres et les candidatures, avec une gestion stricte des rôles via **Middleware**.

---

### 📸 Tests et Validation sur Postman

L'API a été testée et validée avec succès. Voici les preuves de fonctionnement de nos endpoints clés :

---

### 1. 📝 Inscription (Register)

**Création d'un nouveau compte candidat avec succès (201 Created) :**  
![Succès 201](docs/screenshots/Succès%20(201).png)
</br>

**Validation des données — Paramètres manquants ou invalides (Erreur 422) :**  
![Erreur 422](docs/screenshots/Erreur%20(422).png)
</br>

---

### 2. 🔑 Connexion (Login)

**Authentification réussie et récupération du Token JWT (200 OK) :**  
![Login Succès 200](docs/screenshots/Login%20-%20Succès%20(200).png)
</br>

**Token absent ou invalide — Accès refusé (Erreur 401 Unauthorized) :**  
![Login Erreur 401](docs/screenshots/Login%20-%20Erreur%20(401).png)
</br>

---

### 3. 👤 Consultation du Profil Candidat

**Accès protégé aux informations du profil via le Token JWT :**  
![Consulter son profil](docs/screenshots/Consulter%20son%20profil.png)
</br>

---

### 4. ✏️ Modification du Profil

**Un candidat met à jour ses informations personnelles (titre, bio, localisation) :**  
![Modifier son profil](docs/screenshots/Modifier%20son%20profil.png)
</br>

---

### 5. 🚫 Sécurité des Rôles — Le Mur 403 Forbidden

**Tentative bloquée : un candidat essaie de créer une offre d'emploi (action réservée aux recruteurs) :**  
![Créer offre 403 Candidat interdit](docs/screenshots/Créer%20offre%20—%20403%20Candidat%20interdit.png)
</br>

**Tentative bloquée : un candidat essaie de modifier le statut d'une candidature (action réservée aux recruteurs) :**  
![Changer statut 403 Candidat interdit](docs/screenshots/Changer%20statut%20—%20403%20Candidat%20interdit.png)
</br>

---

### 6. 💼 Création d'une Offre d'Emploi

**Un recruteur authentifié crée une nouvelle offre d'emploi avec succès (201 Created) :**  
![Créer une offre Recruteur succès](docs/screenshots/Créer%20une%20offre%20—%20Recruteur%20(succès).png)
</br>

---

### 7. 📨 Gestion des Candidatures

**Un candidat postule à une offre spécifique avec succès :**  
![Postuler Candidat succès](docs/screenshots/Postuler%20—%20Candidat%20(succès).png)
</br>
