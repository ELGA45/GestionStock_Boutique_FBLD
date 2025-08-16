<?php 
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../templates/sidebar.php';

if(isset($_SESSION['connectedUser'])){
?>

<div class="content">
    <div class="container-fluid">

        <div class="tab-bord">
          <h1 class="mb-0">Espace Produit</h1>
        </div>
        <div class="container mt-5">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Modifier une Categorie</h2>
            <a href="/GestionStock_Boutique_FBLD/public/routeurs/categorie.php" class="btn btn-dark">
              🔙 Retour
            </a>
          </div>
        </div>

          <form action="/GestionStock_Boutique_FBLD/public/routeurs/categorie.php?action=update" 
                method="POST" class="p-4 shadow rounded bg-white" 
                style="max-width: 500px; margin: auto; margin-top: 20px">

              <!-- Message d'information -->
              <?php if (!empty($message)): ?>
                  <div class="alert alert-<?= $messageClass ?> text-center">
                      <?= $message ?>
                  </div>
              <?php endif; ?>
              
              <input type="hidden" name="id" value="<?= htmlspecialchars($infoCtg['id']) ?>">
              <!-- Champ Nom -->
              <div class="mb-3">
                  <label for="nom" class="form-label">Nom</label>
                  <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrez le Libellé"
                        value="<?= htmlspecialchars($infoCtg['nom']) ?>" required>
              </div>

              <!-- Bouton -->
              <button type="submit" class="btn btn-dark w-100">Modifier</button>
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