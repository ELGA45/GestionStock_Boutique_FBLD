<?php
require_once __DIR__ . '/BaseModel.php';

class Client extends BaseModel { 

  public function getALL(){
    $sql = "SELECT * FROM client";
    return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById($id){
    $sql = "SELECT * FROM client WHERE id = ?";
    return $this->query($sql, [$id])->fetch(PDO::FETCH_ASSOC);
  }

  public function getCmdByClient($idClient){
        $sql = "SELECT c.id AS idCmd, cl.nom AS client, c.dateCommande, c.etat
                FROM commande c
                JOIN client cl ON cl.id = c.idClient
                WHERE cl.id = ?";
        return $this->query($sql, [$idClient])->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getByEmail($email){
    $sql = "SELECT * FROM client WHERE email = ?";
    return $this->query($sql, [$email])->fetch(PDO::FETCH_ASSOC);
  }

  public function create($nom, $email, $téléphone){
      try {
        $sql = "INSERT INTO client(nom, email, téléphone) VALUES(?, ?, ?)";
        $this->query($sql, [$nom, $email, $téléphone]);
        return "✅ Client ajouter avec succé";
      } catch (PDOException $e) {
        return "❌ Erreur lors de l'ajout : " . $e->getMessage();
      }
  }

  public function update($id, $nom, $email, $téléphone){
      try{
      $sql = "UPDATE client SET nom = ?, email = ?, téléphone = ? WHERE id = ?";
      $this->query($sql, [$nom, $email, $téléphone, $id]);
        return "✅ Client mise a jour avec succée";  
      }
      catch(PDOException $e){
        return "❌ Erreur lors de la mise à jour ". $e->getMessage();
      }
    }

    public function DeleteClient($id){
      $sql = "DELETE FROM client WHERE id = ?";
      $this->query($sql, [$id]);
    }

}