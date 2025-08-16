<?php 
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../templates/sidebar.php';

if(isset($_SESSION['connectedUser'])){
?>

<div class="content">
  <div class="container-fluid">

  <div class="tab-bord">
      <h1 class="mb-0">Espace Client</h1>
    </div>
    <div class="container mt-5">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Ajouter un Client</h2>
        <a href="/GestionStock_Boutique_FBLD/public/routeurs/client.php" class="btn btn-dark">
          🔙 Retour
        </a>
      </div>
    </div>
    <form action="/GestionStock_Boutique_FBLD/public/routeurs/client.php?action=add" 
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

        <!-- Champ Téléphone -->
        <div class="mb-3">
            <label for="tel" class="form-label">Téléphone</label>
            <input type="tel" id="text" name="tel" class="form-control" placeholder="Entrez le téléphone" required>
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
    header('Location:/GestionStock_Boutique_FBLD/public/routeurs/auth.php?action=loginForm');
        exit();
  }
?>