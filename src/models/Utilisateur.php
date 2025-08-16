<?php
require_once __DIR__ . '/BaseModel.php';

class Utilisateur extends BaseModel {

  public function getALL(){
    $sql = "SELECT id, nom, email, rôle, statut FROM utilisateur";
    return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getById($id){
    $sql = "SELECT * FROM utilisateur WHERE id = ?";
    return $this->query($sql, [$id])->fetch(PDO::FETCH_ASSOC);
  }

  public function getByEmail($email){
    $sql = "SELECT * FROM utilisateur WHERE email = ?";
    return $this->query($sql, [$email])->fetch(PDO::FETCH_ASSOC);
  }

  public function create($nom, $email, $mot_de_passe, $role, $statut){
        $motDePasseHache = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        try {
          $sql = "INSERT INTO utilisateur(nom, email, mot_de_passe, rôle, statut) VALUES(?,?,?,?,?)";
          $this->query($sql, [$nom, $email, $motDePasseHache, $role, $statut]);
          return "✅ Utilisateur ajouté avec succès";
        } catch (PDOException $e) {
          return "❌ Erreur lors de l'ajout : " . $e->getMessage();
        }
  }

  public function update($id, $nom, $email, $mot_de_passe, $role, $statut){
    $motDePasseHache = password_hash($mot_de_passe, PASSWORD_DEFAULT);
    try {
      $sql = "UPDATE utilisateur SET  nom = ?,
                                    email = ?,
                                    mot_de_passe = ?,
                                    rôle = ?
                              WHERE id = ?";
        $this->query($sql, [$nom, $email, $motDePasseHache, $role, $id]);
        return "✅ Utilisateur mise à jour avec succès";
      } catch (PDOException $e) {
          return "❌ Erreur lors de la mise à jour : " . $e->getMessage();
      }
  }

  public function updateStatut($id, $statut){
    try {
        $sql = "UPDATE utilisateur SET  statut = ?
                              WHERE id = ?";
        $this->query($sql, [$statut, $id]);
      } catch (PDOException $e) {
          return "❌ Erreur lors de la mise à jour : " . $e->getMessage();
      }
  }

  public function delete($id){
        $sql = "DELETE FROM utilisateur WHERE id = ?";
        $this->query($sql, [$id]);
  }

}