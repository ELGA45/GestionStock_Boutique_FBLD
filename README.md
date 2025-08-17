# GestionStock_Boutique_FLD

## Description
Application web PHP simple permettant de gérer les produits, les catégories, les clients, et les commandes.<br> Utilise une architecture MVC (Models / Controllers / Views) pour une meilleure organisation du code.<br>

---<br>

## Structure du projet

GestionStock_Boutique_FLD/
│
├── config/                         
│   ├── database.php          # Connexion PDO centralisée
│   ├── config.php            # Variables globales (URL, chemin base, constantes)
│
├── public/                   # Racine publique du projet (accessible depuis le navigateur)
│   ├── dashboard.php         # Tableau de bord (page d’accueil après login)
│   │
│   ├── routes/               # Regroupe les points d’entrée de chaque module
│   │   ├── auth.php          # Entrée Authentification (login, logout)
│   │   ├── produit.php       # Entrée gestion produits
│   │   ├── categorie.php     # Entrée gestion catégories
│   │   ├── client.php        # Entrée gestion clients
│   │   ├── commande.php      # Entrée gestion commandes
│   │   └── utilisateur.php   # Entrée gestion utilisateurs
│   │
│   ├── uploads/              # Fichiers uploadés
│   │   ├── produits/         # Images produits
│   │   └── clients/          # Images clients (optionnel)
│   │
│   ├── css/
│   │   ├── style.css         # Styles personnalisés
│   │   └── bootstrap.min.css # Bootstrap local
│   │
│   ├── js/
│   │   └── app.js            # Scripts personnalisés (validation formulaires, etc.)
│   │
│   └──images/
│       └── logo.png          # Logo de la boutique
│ 
│
│
├── src/
│   ├── controllers/          # Contrôleurs : logique métier
│   │   ├── AuthController.php
│   │   ├── ProduitController.php
│   │   ├── CategorieController.php
│   │   ├── ClientController.php
│   │   ├── CommandeController.php
│   │   └── UtilisateurController.php
│   │
│   ├── models/               # Modèles : accès BDD via PDO
│   │   ├── BaseModel.php
│   │   ├── Utilisateur.php
│   │   ├── Produit.php
│   │   ├── Categorie.php
│   │   ├── Client.php
│   │   └── Commande.php
│   │
│   └── views/                # Vues (HTML/PHP)
│       ├── templates/        # Templates communs
│       │   ├── header.php
│       │   ├── footer.php
│       │   ├── navbar.php
│       │   └── sidebar.php
│       │
│       ├── auth/             # Authentification
│       │   ├── login.php
│       │   ├── register.php
│       │   └── logout.php
│       │
│       ├── produits/         # CRUD Produits
│       │   ├── index.php
│       │   ├── add.php
│       │   ├── edit.php
│       │   └── delete.php
│       │
│       ├── categories/       # CRUD Catégories
│       │   ├── index.php
│       │   ├── produitByCategorie.php
│       │   ├── add.php
│       │   ├── edit.php
│       │   └── delete.php
│       │
│       ├── clients/          # CRUD Clients
│       │   ├── index.php
│       │   ├── CommandeByClient.php
│       │   ├── add.php
│       │   ├── edit.php
│       │   └── delete.php
│       │
│       ├── commandes/        # CRUD Commandes + suivi état
│       │   ├── index.php
│       │   ├── add.php
│       │   ├── edit.php
│       │   ├── editEtat.php
│       │   └── delete.php
│       │
│       └── utilisateurs/     # CRUD Utilisateurs
│           ├── index.php
│           ├── add.php
│           ├── edit.php
│           └── delete.php
│
├── sql/
│   └── gestionstock.sql      # Script SQL complet
│
├── .htaccess                 # Redirections + sécurité
├── README.md                 # Documentation du projet
└── composer.json             # Autoload (si Composer utilisé)



---

##  Installation

1. Clone le dépôt : <br>
   ```bash
   git clone https://github.com/ELGA45/GestionStock_Boutique_FLD.git
<br>
---<br>

##  Installation

1. Clone le dépôt :
   ```bash
   git clone https://github.com/ELGA45/GestionStock_Boutique_FLD.git 
   dossier dans ton serveur local (htdocs, www, etc.).<br>
2. Exécute le script SQL dans sql/gestionstock.sql pour créer la base de données.<br>

3. Ouvre config/database.php et ajuste les identifiants (host, dbname, user, pass).<br>

4. Accède à http://localhost/GestionStock_Boutique_FLD/public/ pour commencer à utiliser l’application.<br>

## Fonctionnalités principales

Gestion des produits (CRUD : création, liste, modification, suppression) avec catégorie associée.<br>

Gestion des commandes : création (avec validation stock), consultation, mise à jour de l’état, suppression (avec restitution du stock si déjà livrée).<br>

Gestion des utilisateurs (admin/employé).<br>

## Note de développement

Chaque modèle hérite de BaseModel.php, qui gère la connexion à la base via PDO.<br>

Les controllers (ProduitController, CommandeController, ...) orchestrent les flux GET/POST, valident les données, appellent les modèles, puis chargent la vue correspondante.<br>

Les vues sont basées sur Bootstrap pour un rendu visuel propre et responsive.<br>

Les fichiers (formulaires) utilisent des validateurs simples côté PHP, et renvoient des messages clairs avec emojis (ex. : ✅, ⚠️, ❌).<br>

## Contribution

N’hésite pas à proposer des améliorations (meilleure gestion des sessions, role-based access control, validation JS, upload sécurisé, etc.).<br>              