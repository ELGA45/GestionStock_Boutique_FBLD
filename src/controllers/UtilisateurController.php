<?php
require_once __DIR__ . '/../models/Utilisateur.php';

class UtilisateurController {

    public function index() {
        $user = new Utilisateur();
        $users = $user->getAll();

        function verifieRole($role){
          if($role == 'admin'){
            return true;
          }
          else {
            return false;
          }
        }

        include __DIR__ . '/../views/utilisateurs/index.php';
    }

    public function addForm($message, $messageClass) {
        include __DIR__ . '/../views/utilisateurs/add.php';
    }

    public function add(){
      $nom = $_POST['nom'] ?? '';
      $email = $_POST['email'] ?? '';
      $mot_de_passe = $_POST['mot_de_passe'] ?? '';
      $role = $_POST['role'] ?? '';
      $statut = $_POST['statut'] ?? '';

      $newUser = new Utilisateur();
      $emailUser = $newUser->getByEmail($email);

      if (!$emailUser) {
          $message = $newUser->create($nom, $email, $mot_de_passe, $role, $statut);

          // Couleur du message selon contenu
          if (strpos($message, '✅') !== false) {
              $messageClass = "success";
          } elseif (false || strpos($message, '❌') !== false) {
              $messageClass = "danger";
          }
      } else {
          $message = "⚠️ Cet e-mail est déjà enregistré";
          $messageClass = "warning";
      }
      header('Location: /GestionStock_Boutique_FBLD/public/routeurs/utilisateur.php?action=addForm&m='.$message.'&mc='.$messageClass);
    }
    
    public function editForm($id, $message, $messageClass){
      $user = new Utilisateur;
      $infoUser = $user->getById($id);
      if($infoUser){
        include __DIR__ . '/../views/utilisateurs/edit.php';
      }
      else {
        $this->index();
      }
    }

    public function update($id) {
      $nom = $_POST['nom'] ?? '';
      $email = $_POST['email'] ?? '';
      $mot_de_passe = $_POST['mot_de_passe'] ?? '';
      $role = $_POST['role'] ?? '';
      $statut = $_POST['statut'] ?? '';

      $editUser = new Utilisateur();

      $message = $editUser->update($id, $nom, $email, $mot_de_passe, $role, $statut,);

      if (strpos($message, '✅') !== false) {
              $messageClass = "success";
      } elseif (strpos($message, '❌') !== false) {
              $messageClass = "danger";
      }
      header('Location: /GestionStock_Boutique_FBLD/public/routeurs/utilisateur.php?action=addForm&m='.$message.'&mc='.$messageClass);
    }

    public function updateStatut($id){
        $user = new Utilisateur();
        $infoUser = $user->getById($id);

        if($infoUser){
          $statut = $infoUser['statut'] == "actif"?"inactif":"actif";
          $user->updateStatut($id, $statut);
          $this->index();
        }
    }

    public function deleteForm($id) {
      $user = new Utilisateur;
      $infoUser = $user->getById($id);
      if($infoUser){
        include __DIR__ . '/../views/utilisateurs/delete.php';
      }
      else {
        $this->index();
      }
    }

    public function delete($id, $confirm) {
      if($confirm === 'oui' ){
        $user = new Utilisateur;
        $user->delete($id);
      }
        $this->index(); // Retour à la liste
    }

}