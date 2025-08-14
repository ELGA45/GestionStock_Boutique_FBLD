<?php
require_once __DIR__ . '/BaseModel.php';

class Produit extends BaseModel {
    public function getAll() {
        $sql = "SELECT p.*, c.nom AS categorie_nom 
                FROM produit p 
                lEFT JOIN categorie c ON c.id = p.idCategorie";
        return $this->query($sql)->fetchAll();
    }

    public function getById($id) {
        $sql = "SELECT * FROM produit WHERE id = ?";
        return $this->query($sql, [$id])->fetch();
    }

    public function getByNom($nom) {
        $sql = "SELECT * FROM produit WHERE nom = ?";
        return $this->query($sql, [$nom])->fetch();
    }

    public function create($nom, $prix, $stock, $idCategorie) {
        $sql = "INSERT INTO produit(nom, prix, stock, idCategorie) VALUES (?, ?, ?, ?)";
        try {
          $this->query($sql, [$nom, $prix, $stock, $idCategorie]);
          return "✅ Produit ajouté avec succès";
        } catch (PDOException $e) {
        return "❌ Erreur lors de l'ajout : " . $e->getMessage();
      }   
    }

    public function update($id, $nom, $prix, $stock, $idCategorie) {
        $sql = "UPDATE produit SET nom = ?, prix = ?, stock = ?, idCategorie = ? WHERE id = ?";
        try {
          $this->query($sql, [$nom, $prix, $stock, $idCategorie, $id]);
          return "✅ Produit mise à jour avec succès";
        } catch (PDOException $e) {
        return "❌ Erreur lors de la mise à jour : " . $e->getMessage();
      }   
    }



    public function delete($id) {
        $sql = "DELETE FROM produit WHERE id = ?";
        return $this->query($sql, [$id]);
    }


}