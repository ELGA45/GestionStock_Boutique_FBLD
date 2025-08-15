<?php 
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../templates/sidebar.php';

if(isset($_SESSION['connectedUser'])){
?>

<div class="content">
  <div class="container-fluid">

  <div class="tab-bord">
      <h1 class="mb-0">Espace Utilisateur</h1>
    </div>
    <div class="container mt-5">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Ajouter un utilisateur</h2>
        <a href="/GestionStock_Boutique_FBLD/public/routeurs/utilisateur.php" class="btn btn-dark">
          🔙 Retour
        </a>
      </div>
    </div>
    <form action="/GestionStock_Boutique_FBLD/public/routeurs/utilisateur.php?action=add" 
          method="POST" class="p-4 shadow rounded bg-white" 
          style="max-width: 500px; margin: auto; margin-top: 20px">
  
        <!-- Message d'information -->
        <?php if (!empty($message)): ?>
            <div class="alert alert-<?= $messageClass ?> text-center">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <!-- Champ Nom -->
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrez le nom"
                  value="<?= htmlspecialchars($nom ?? '') ?>" required>
        </div>

        <!-- Champ Email -->
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Entrez l'e-mail"
                  value="<?= htmlspecialchars($email ?? '') ?>" required>
        </div>

        <!-- Champ Mot de passe -->
        <div class="mb-3">
            <label for="mot_de_passe" class="form-label">Mot de passe</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" placeholder="Entrez le mot de passe" required>
        </div>

        <!-- Champ Rôle -->
        <div class="mb-3">
            <label for="role" class="form-label">Rôle</label>
            <select id="role" name="role" class="form-select" required>
                <option value="">-- Sélectionner --</option>
                <option value="admin" <?= (isset($role) && $role === 'admin') ? 'selected' : '' ?>>Administrateur</option>
                <option value="employé" <?= (isset($role) && $role === 'employé') ? 'selected' : '' ?>>Employé</option>
            </select>
        </div>

        <!-- Champ Statut -->
        <div class="mb-4">
            <label for="statut" class="form-label">Statut</label>
            <select id="statut" name="statut" class="form-select" required>
                <option value="">-- Sélectionner --</option>
                <option value="actif" <?= (isset($statut) && $statut === 'actif') ? 'selected' : '' ?>>Actif</option>
                <option value="inactif" <?= (isset($statut) && $statut === 'inactif') ? 'selected' : '' ?>>Inactif</option>
            </select>
        </div>

        <!-- Bouton -->
        <button type="submit" class="btn btn-dark w-100">Enregistrer</button>
    </form>
  </div>
</div>


<?php 
    include __DIR__ . '/../templates/footer.php'; 
  }
  else {
    header('Location:/GestionStock_Boutique_FBLD/public/routeurs/auth.php?actionloginForm');
        exit();
  }
?>