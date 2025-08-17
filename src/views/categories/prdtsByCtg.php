<?php 
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../templates/sidebar.php';

if(isset($_SESSION['connectedUser'])){
?>

<div class="content">
  <div class="container-fluid">

  <div class="tab-bord">
      <h1 class="mb-0">Espace Catégorie <?= htmlspecialchars($infoCtg['nom']) ?></h1>
    </div>
    <div class="container mt-5">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="/GestionStock_Boutique_FBLD/public/routeurs/categorie.php" class="btn btn-dark">
          🔙 Retour
        </a>
      </div>
    </div>
    <div class="card shadow">
            <div class="card-body">
              <?php 
                  if($prdts){ ?>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover">
                        <thead class="table-dark">
                          <tr class="bg-dark text-white" >
                            <th>Libellé</th>
                            <th>Prix (FCFA)</th>
                            <th>Stock</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($prdts as $prdt) { ?>
                            <tr>
                              <td><?= htmlspecialchars($prdt['nom']) ?></td>
                              <td><?= number_format($prdt['prix'], 2, ',', ' ') ?></td>
                              <td><?= number_format($prdt['stock']) ?></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
            <?php } 
                  else { ?>
                    <div class="alert alert-warning m-3">Aucun produit trouvé.</div>
                <?php } ?>
            </div>
          </div>
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