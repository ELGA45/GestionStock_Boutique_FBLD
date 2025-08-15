<?php
  require_once __DIR__ . '/../models/Categorie.php';

  class CategorieController {

    public function index() {
        $categorie = new Categorie();
        $categories = $categorie->getAll();
        include __DIR__ . '/../views/categories/index.php';
    }

    public function addForm($message, $messageClass) {
        include __DIR__ . '/../views/categories/add.php';
    }

    public function add() {
        $nom = $_POST['nom'] ?? '';

        $newCtg = new Categorie();
        $nomCtg = $newCtg->getByNom($nom);

        if (!$nomCtg) {
            $message = $newCtg->create($nom);

            // Couleur du message selon contenu
            if (strpos($message, '✅') !== false) {
                $messageClass = "success";
            } elseif (strpos($message, '❌') !== false) {
                $messageClass = "danger";
            }
        } else {
            $message = "⚠️ Cet Libellé est déjà enregistré";
            $messageClass = "warning";
        }
        header('Location: /GestionStock_Boutique_FBLD/public/routeurs/produit.php?action=addForm&m='.$message.'&mc='.$messageClass);
    }

    public function editForm($id, $message, $messageClass) {
        $categorie = new Categorie();
        $infoCtg = $categorie->getById($id);
        if($infoCtg){
          include __DIR__ . '/../views/categories/edit.php';
        }
        else{
          $this->index(); // Retour à la liste
        }
    }

    public function update($id) {
        $nom = $_POST['nom'] ?? '';

        $editCtg = new Categorie();
        $message = $editCtg->update($id, $nom);

        if (strpos($message, '✅') !== false) {
                $messageClass = "success";
        } elseif (strpos($message, '⛔') !== false || strpos($message, '❌') !== false) {
                $messageClass = "danger";
        }
    }

    public function deleteForm($id) {
        $categorie = new Categorie();
        $infoCtg = $categorie->getById($id);
        if($infoCtg){
          include __DIR__ . '/../views/categories/delete.php';
        }
        else{
          $this->index(); // Retour à la liste
        }
    }

    public function delete($id, $confirm) {
      if($confirm === 'oui' ){
        $categorie = new Produit();
        $categorie->delete($id);
      }
        $this->index(); // Retour à la liste
    }


  }