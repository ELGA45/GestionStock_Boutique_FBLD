<?php
require_once __DIR__ . '/../models/Produit.php';
require_once __DIR__ . '/../models/Categorie.php';

class ProduitController {

    public function index() {
        $produit = new Produit();
        $produits = $produit->getAll();
        include __DIR__ . '/../views/produits/index.php';
    }
    

    public function addForm($message, $messageClass) {
        $categorie = new Categorie();
        $categories = $categorie->getAll();
        include __DIR__ . '/../views/produits/add.php';
    }

    public function add() {
        $nom = $_POST['nom'] ?? '';
        $prix = $_POST['prix'] ?? 0;
        $stock = $_POST['stock'] ?? 0;
        $idCategorie = $_POST['idCategorie'] ?? null;


        $produit = new Produit();
        $prod = $produit->getByNom($nom);

        if (!$prod) {
            $message = $produit->create($nom, $prix, $stock, $idCategorie);
       // Couleur du message selon contenu
        if (strpos($message, '✅') !== false) {
            $messageClass = "success";
        } elseif (strpos($message, '❌') !== false) {
            $messageClass = "danger";
        }
        } else {
            $message = "⚠️ Cet nom est déjà enregistré";
            $messageClass = "warning";
        }
        header('Location: /GestionStock_Boutique_FBLD/public/routeurs/produit.php?action=addForm&m='.$message.'&mc='.$messageClass);
    }

    public function editForm($id, $message, $messageClass) {
        $produit = new Produit();
        $categorie = new Categorie();
        $categories = $categorie->getAll();
        $infoPrdt = $produit->getById($id);
        if($infoPrdt){
          include __DIR__ . '/../views/produits/edit.php';
        }
        else{
          $this->index(); // Retour à la liste
        }
    }

    public function update($id) {
        $nom = $_POST['nom'] ?? '';
        $prix = $_POST['prix'] ?? 0;
        $stock = $_POST['stock'] ?? 0;
        $idCategorie = $_POST['idCategorie'] ?? null;

        $produit = new Produit();
        $prod = $produit->getByNom($nom);

        
        $message = $produit->update($id, $nom, $prix, $stock, $idCategorie);

        if (strpos($message, '✅') !== false) {
            $messageClass = "success";
        } elseif (strpos($message, '❌') !== false) {
            $messageClass = "danger";
        }
        header('Location: /GestionStock_Boutique_FBLD/public/routeurs/produit.php?action=editForm&id='.$id.'&m='.$message.'&mc='.$messageClass);
    }

    public function deleteForm($id) {
        $produit = new Produit();
        $infoPrdt = $produit->getById($id);
        if($infoPrdt){
          include __DIR__ . '/../views/produits/delete.php';
        }
        else{
          $this->index(); // Retour à la liste
        }
    }

    public function delete($id, $confirm) {
      if($confirm === 'oui' ){
        $produit = new Produit();
        $produit->delete($id);
      }
        $this->index(); // Retour à la liste
    }

}