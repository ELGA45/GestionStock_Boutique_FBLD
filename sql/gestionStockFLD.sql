-- 1. Création de la base de données
CREATE DATABASE IF NOT EXISTS gestionStockFLD;
USE gestionStockFLD;

-- 2. Table utilisateur
CREATE TABLE utilisateur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    rôle ENUM('admin','employé') DEFAULT 'employé',
    statut ENUM('actif','inactif') DEFAULT 'actif'
);

-- 3. Table catégorie
CREATE TABLE categorie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

-- 4. Table produit
CREATE TABLE produit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    idCategorie INT,
    FOREIGN KEY (idCategorie) REFERENCES categorie(id) ON DELETE SET NULL
);

-- 5. Table client
CREATE TABLE client (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(150) NOT NULL,
    email VARCHAR(150),
    téléphone VARCHAR(20)
);

-- 6. Table commande
CREATE TABLE commande (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idClient INT NOT NULL,
    dateCommande DATE NOT NULL,
    FOREIGN KEY (idClient) REFERENCES client(id) ON DELETE CASCADE
);

-- 7. Table commande_produit (table de liaison entre commande et produit)
CREATE TABLE commande_produit (
    idCommande INT NOT NULL,
    idProduit INT NOT NULL,
    quantite INT NOT NULL,
    PRIMARY KEY (idCommande, idProduit),
    FOREIGN KEY (idCommande) REFERENCES commande(id) ON DELETE CASCADE,
    FOREIGN KEY (idProduit) REFERENCES produit(id) ON DELETE CASCADE
);
