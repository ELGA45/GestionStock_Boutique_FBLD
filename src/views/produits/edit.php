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
            <h2>Modifier un Produit</h2>
            <a href="/GestionStock_Boutique_FBLD/public/routeurs/produit.php" class="btn btn-dark">
              🔙 Retour
            </a>
          </div>
        </div>

          <form action="/GestionStock_Boutique_FBLD/public/routeurs/produit.php?action=update" method="POST" class="p-4 shadow rounded bg-white" style="max-width: 500px; margin: auto; margin-top: 20px">

              <!-- Message d'information -->
              <?php if (!empty($message)): ?>
                  <div class="alert alert-<?= $messageClass ?> text-center">
                      <?= $message ?>
                  </div>
              <?php endif; ?>
              
              <input type="hidden" name="id" value="<?= htmlspecialchars($infoPrdt['id']) ?>">
              <!-- Champ Nom -->
              <div class="mb-3">
                  <label for="nom" class="form-label">Nom</label>
                  <input type="text" id="nom" name="nom" class="form-control"
                        value="<?= htmlspecialchars($infoPrdt['nom']) ?>" required>
              </div>

              <!-- Champ prix -->
        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" id="prix" name="prix" class="form-control"
                    value="<?= htmlspecialchars($infoPrdt['prix']) ?>" required>
        </div>

        <!-- Champ stock -->
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" id="stock" name="stock" class="form-control" 
                    value="<?= number_format($infoPrdt['stock']) ?>" required>
        </div>
        
        <!-- Champ categorie -->
        <div class="mb-3">
            <label for="categorie" class="form-label">Catégorie</label>
            <select id="categorie" name="idCategorie" class="form-select" required>
          <?php foreach($categories as $ctg){ ?>
                  <option <?= $ctg['id'] ===  $infoPrdt['idCategorie']?'selected':''?>
                    value="<?= htmlspecialchars($ctg['id']) ?>"><?= htmlspecialchars($ctg['nom']) ?>
                  </option>
          <?php  } ?>
            </select>
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