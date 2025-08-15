<?php
require_once __DIR__ . '/BaseModel.php';

class Categorie extends BaseModel {

    public function getAll() {
        $sql = "SELECT c.id, c.nom, COUNT(p.id) AS nbr_prdt
                                  FROM categorie c
                                  LEFT JOIN produit p ON p.idCategorie = c.id
                                  GROUP BY c.id, c.nom";
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id){
      $sql = "SELECT * FROM categorie WHERE id = ?";
      return $this->query($sql, [$id])->fetch(PDO::FETCH_ASSOC);
    }

    public function getByNom($nom){
      $sql = "SELECT * FROM categorie WHERE nom = ?";
      return $this->query($sql, [$nom])->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nom){
      try {
        $sql = "INSERT INTO categorie(nom) VALUES(?)";
        $this->query($sql, [$nom]);
        return "✅ Categorie ajouter avec succé";
      } catch (PDOException $e) {
        return "❌ Erreur lors de l'ajout : " . $e->getMessage();
      }
    }

    public function update($id, $nom){
      try{
        $sql = "UPDATE categorie SET nom = ? WHERE id = ?";
        $this->query($sql, [$nom, $id]);
          return "✅ Categorie mise a jour avec succée";  
        }
        catch(PDOException $e){
          return "❌ Erreur lors de la mise à jour ". $e->getMessage();
        }
    }

    public function delete($id){
      $sql = "DELETE FROM categorie WHERE id = ?";
      $this->query($sql, [$id]);
    }
}
