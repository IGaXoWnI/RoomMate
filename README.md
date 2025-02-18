
---

# 🏠 **RoomMate YouCode**  
**Plateforme de Recherche de Colocataires pour les Étudiants de YouCode**  

---

## 📝 **Description**  
RoomMate YouCode est une plateforme dédiée aux étudiants de YouCode pour faciliter la recherche de colocataires et de logements. Elle offre des fonctionnalités complètes pour gérer les profils, les annonces, les matchs, et la communication entre utilisateurs.  

---

### 👫 **Projet réalisé en équipe** :
- **BadrEddine MassaAlkhayr**
- **Salahdine Daha**  
- **Ismail Baguni**  


## 🚀 **Fonctionnalités Principales**  

### 🔐 **1. Authentification & Profils**  
| Fonctionnalité                          | Description                                                                 |
|-----------------------------------------|-----------------------------------------------------------------------------|
| **Vérification email YouCode**          | Seuls les emails avec le domaine `@youcode.ma` sont acceptés.               |
| **Validation par code**                 | Un code est envoyé par email pour valider le compte.                        |
| **Profil étudiant**                     | Nom complet, année d'études, villes, biographie, préférences, photo, etc.   |
| **Référence d'ancien colocataire**      | Option pour ajouter une référence d'un ancien colocataire.                  |

---

### 📢 **2. Gestion des Annonces**  
| Type d'Annonce                          | Description                                                                 |
|-----------------------------------------|-----------------------------------------------------------------------------|
| **"J'ai un Logement"**                  | Localisation, loyer, capacité, équipements, règles, photos (max 5).         |
| **"Recherche Logement/Colocataires"**   | Zones géographiques, budget, préférences, type de recherche.                |

---

### 💡 **3. Système de Matching**  
| Fonctionnalité                          | Description                                                                 |
|-----------------------------------------|-----------------------------------------------------------------------------|
| **Algorithme de matching**              | Basé sur la compatibilité budgétaire, géographique, et des préférences.     |
| **Score de compatibilité**              | Affiche un score de compatibilité entre les profils et les annonces.        |

---

### 💬 **4. Communication**  
| Fonctionnalité                          | Description                                                                 |
|-----------------------------------------|-----------------------------------------------------------------------------|
| **Messagerie intégrée**                 | Permet aux utilisateurs de communiquer entre eux.                           |
| **Partage d'images**                    | Possibilité de partager des images dans les messages.                       |
| **Historique des messages**             | Conservation des conversations pour chaque utilisateur.                     |

---

### 🔍 **5. Recherche & Filtres**  
| Fonctionnalité                          | Description                                                                 |
|-----------------------------------------|-----------------------------------------------------------------------------|
| **API RESTful**                         | Filtres par prix, localisation, période, nombre de colocataires.            |
| **Interface de recherche**              | Interface utilisateur pour appliquer les filtres.                           |

---

### 👨‍💻 **6. Interface Administrateur**  
| Fonctionnalité                          | Description                                                                 |
|-----------------------------------------|-----------------------------------------------------------------------------|
| **Tableau de bord**                     | Métriques clés : utilisateurs actifs, annonces, taux de réussite, etc.      |
| **Gestion des utilisateurs**            | Blocage, déblocage, suppression, réinitialisation de mot de passe.          |
| **Gestion des annonces**                | Validation, rejet, modification, suppression des annonces.                  |
| **Gestion des signalements**            | Suivi et catégorisation des contenus signalés.                              |

---

## 🎁 **Bonus**  
- **Connexion avec réseaux sociaux** : Se connecter via Facebook, Google, etc.  
- **Live chat intégré** : Chat en direct pour les utilisateurs.  
- **Affichage des logements sur carte** : Intégration de Google Maps.  

---

## 🛠️ **Technologies Utilisées**  
- **Frontend** : Html Css, Tailwind CSS  
- **Backend** : Php (MVC)  
- **Base de données** : Mysql
- **API** : RESTful  
- **Cartographie** : Google Maps API  

---

## 📂 **Structure du Projet**  
```
RoomMateYouCode/
│── app/
│   ├── controllers/
│   │   ├── AuthController.php
│   │   ├── UserController.php
│   │   ├── ListingController.php
│   │   ├── MatchController.php
│   │   ├── MessageController.php
│   │   ├── AdminController.php
│   ├── models/
│   │   ├── User.php
│   │   ├── Listing.php
│   │   ├── Match.php
│   │   ├── Message.php
│   │   ├── Report.php
│   ├── views/
│   │   ├── auth/ 
│   │   │   ├── login.php
│   │   │   ├── register.php
│   │   ├── users/
│   │   │   ├── profile.php
│   │   │   ├── dashboard.php
│   │   ├── listings/
│   │   │   ├── create.php
│   │   │   ├── view.php
│   │   │   ├── edit.php
│   │   ├── messages/
│   │   │   ├── inbox.php
│   │   │   ├── chat.php
│   │   ├── admin/
│   │   │   ├── dashboard.php
│   │   │   ├── users.php
│   │   │   ├── listings.php
│   │   │   ├── reports.php
│   ├── core/
│   │   ├── Database.php
│   │   ├── Controller.php
│   │   ├── Model.php
│   │   ├── View.php
│   │   ├── Router.php
│── public/
│   ├── assets/
│   │   ├── css/
│   │   │   ├── style.css
│   │   ├── js/
│   │   │   ├── app.js
│   │   ├── images/
│   ├── index.php
│   ├── .htaccess
│── config/
│   ├── config.php
│── routes/
│   ├── web.php
│── storage/
│   ├── uploads/
│── tests/
│   ├── UserTest.php
│   ├── ListingTest.php
│── .env
│── composer.json
│── README.md
```
---

## 🚀 Installation et démarrage du projet

### 1️⃣ **Cloner le projet **
Si vous n’avez pas encore le projet, vous pouvez le cloner depuis un dépôt Git :

```

git clone https://github.com/IGaXoWnI/RoomMate.git

```

## 🚀 Démarrer le serveur PHP intégré

```
cd mon-projet-mvc
```

```
php -S localhost:8000 public
```

Une fois le serveur lancé, ouvrez votre navigateur et accédez à l’URL suivante :

👉 http://localhost:8000

---

## 🤝 **Contribution**  
Les contributions sont les bienvenues ! Pour contribuer :  
1. Forkez le projet.  
2. Créez une branche (`git checkout -b feature/NouvelleFonctionnalité`).  
3. Committez vos changements (`git commit -m 'Ajouter une nouvelle fonctionnalité'`).  
4. Pushez la branche (`git push origin feature/NouvelleFonctionnalité`).  
5. Ouvrez une Pull Request.  

---

## 🙏 **Remerciements**  

- **YouCode** pour l'inspiration et le soutien.   

---

✨ **Fait avec ❤️ par l'équipe RoomMate YouCode** ✨  

---
