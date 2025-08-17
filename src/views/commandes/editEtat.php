<?php 
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../templates/sidebar.php';

$etat = ['en attente', 'en cours', 'livrée'];

if(isset($_SESSION['connectedUser'])){
?>

<div class="content">
  <div class="container-fluid">
    <div class="tab-bord">
      <h1 class="mb-0">Modifier l'état de la commande #<?= htmlspecialchars($idCommande) ?></h1>
    </div>

    <div class="container mt-5">
      <a href="/GestionStock_Boutique_FBLD/public/routeurs/commande.php" class="btn btn-dark mb-4">
        🔙 Retour
      </a>

      <form action="/GestionStock_Boutique_FBLD/public/routeurs/commande.php?action=updateEtat" 
            method="POST" class="p-4 shadow rounded bg-white" 
            style="max-width: 500px; margin: auto;">
        <div class="mb-3">
          <input type="hidden" name="id" value="<?= htmlspecialchars($idCommande) ?>">
          <label for="etat" class="form-label">État de la commande</label>
          <select id="etat" name="etat" class="form-select" required>
            <?php 
              foreach($etat as $e){ 
              ?>
                <option value="<?= $e ?>" <?= $infoCmd['etat'] == $e? 'selected' : '' ?>>
                  <?= $e ?>
                </option>
              <?php } ?>
          </select>
        </div>

        <button type="submit" class="btn btn-dark w-100">Mettre à jour</button>
      </form>
    </div>
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