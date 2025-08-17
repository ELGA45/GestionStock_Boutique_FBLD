<?php 
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../templates/sidebar.php';

if(isset($_SESSION['connectedUser'])){
?>

<div class="content">
  <div class="container-fluid">
    <div class="tab-bord">
      <h1 class="mb-0">Modifier la commande #<?= htmlspecialchars($idCommande) ?></h1>
    </div>

    <div class="container mt-5">
      <a href="/GestionStock_Boutique_FBLD/public/routeurs/commande.php" class="btn btn-dark mb-4">
        🔙 Retour
      </a>

      <?php if (!empty($message)): ?>
        <div class="alert alert-<?= $messageClass ?>"><?= $message ?></div>
      <?php endif; ?>

      <form action="/GestionStock_Boutique_FBLD/public/routeurs/commande.php?action=update" method="POST" class="p-4 shadow rounded bg-white" style="max-width: 600px; margin: auto;">

        <!-- Client -->
        <div class="mb-3">
          <input type="hidden" name="id" value="<?= htmlspecialchars($idCommande) ?>">
          <label for="idClient" class="form-label">Client</label>
          <select name="idClient" id="idClient" class="form-select" required>
            <?php foreach ($clients as $client) { ?>
              <option value="<?= $client['id'] ?>" <?= ($details && $client['nom'] === $infoCmd['idClient']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($client['nom']) ?>
              </option>
            <?php } ?>
          </select>
        </div>

        <!-- Produits -->
        <div id="produitsContainer">
          <?php foreach ($details as $index => $prod) { ?>
            <div class="row mb-3">
              <div class="col-md-6">
                <select name="produit[]" class="form-select" required>
                  <option value="">-- Produit --</option>
                  <?php foreach ($produits as $p) { ?>
                    <option value="<?= $p['id'] ?>" <?= ($p['nom'] === $prod['nom']) ? 'selected' : '' ?>>
                      <?= htmlspecialchars($p['nom']) ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4">
                <input type="number" name="quantite[]" class="form-control" value="<?= $prod['quantite'] ?>" min="1" required>
              </div>
            </div>
          <?php } ?>
        </div>

        <!-- Bouton -->
        <button type="submit" class="btn btn-dark w-100">Modifier</button>
      </form>
    </div>
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