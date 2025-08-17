<?php
  session_start();
  include '../src/views/templates/header.php';
  include '../src/views/templates/sidebar.php';
  require_once __DIR__ . '/../src/controllers/ProduitController.php';
  require_once __DIR__ . '/../src/controllers/CommandeController.php';

  if(isset($_SESSION['connectedUser'])){
    $controllerPrdt = new ProduitController();
    $info = $controllerPrdt->info();

    $controllerCmd = new CommandeController();
    $mvt = $controllerCmd->info();

    $nbrCmd = 0
?>

    <!-- Contenu principal -->

  <div class="content">
    <div class="container-fluid">

      <!-- Barre fixe avec titre -->
      <div class="tab-bord">
        <h1 class="mb-0">Tableau de bord</h1>
      </div>

      <!-- Contenu qui défile -->
      <div class="main-dashboard">

        <!-- Cartes statistiques -->
        <div class="row mb-4">
          <div class="col-md-4">
            <div class="card text-center shadow-sm">
              <div class="card-body">
                <h5 class="card-title">Nombre de produits</h5>
                <p class="display-6 fw-bold text-primary"><?= htmlspecialchars($info['nbrProduit']) ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-center shadow-sm">
              <div class="card-body">
                <h5 class="card-title">Stock total</h5>
                <p class="display-6 fw-bold text-success"><?= htmlspecialchars($info['stockTotal']) ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-center shadow-sm">
              <div class="card-body">
                <h5 class="card-title">Valeur totale</h5>
                <p class="display-6 fw-bold text-danger"><?= number_format($info['valeurTotal'], 2, ',', ' ') ?> FCFA</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Tableau des mouvements récents -->
        <div class="card shadow-sm">
          <div class="card-header bg-dark text-white">
            Commandes récentes
          </div>
          <div class="card-body p-0">
            <table class="table table-striped table-hover ">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nom</th>
                  <th>Date</th>
                  <th>Etat</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($mvt as $cmd) { 
                  $nbrCmd++;
                ?>
                    <tr>
                      <td><?= htmlspecialchars($cmd['id']) ?></td>
                      <td><?= htmlspecialchars($cmd['client']) ?></td>
                      <td><?= htmlspecialchars($cmd['dateCommande']) ?></td>
                      <td><?= htmlspecialchars($cmd['etat']) ?></td>
                  </tr>
                <?php 
                  if($nbrCmd == 10){
                    break;
                  }
              } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div><!-- Fin main-dashboard -->
    </div>
  </div>

<?php
      include '../src/views/templates/footer.php';

  }
  else {
    header('Location:/GestionStock_Boutique_FBLD/public/routeurs/auth.php?action=loginForm');
        exit();
  }

?>