<?php 
  require_once __DIR__ . '/../models/Utilisateur.php';

  class AuthController{

    public function loginForm(){
      include __DIR__ . '/../views/auth/login.php';
    }

    public function login($email, $password){
      $user = New Utilisateur();
      $emailUser = $user->getByEmail($email);

      if($emailUser && password_verify($password, $emailUser['mot_de_passe'])){
        $_SESSION['connectedUser'] = $emailUser;
        header('Location:/GestionStock_Boutique_FBLD/public/dashbord.php');
        exit();
      }
      else{
        header('Location:/GestionStock_Boutique_FBLD/public/routeurs/auth.php?error=1');
        exit();
      }
    }

    public function logoutForm(){
      include __DIR__ . '/../views/auth/logout.php';
    }

    public function logout($confirm){
        if ($confirm === "oui") {
            unset($_SESSION['connectedUser']);
            session_destroy();
            $this->loginForm();
        } else {
            header('Location:/GestionStock_Boutique_FBLD/public/dashbord.php');
            exit();
        }
    }

  }