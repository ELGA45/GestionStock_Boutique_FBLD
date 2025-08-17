<?php 
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../templates/sidebar.php';

if(isset($_SESSION['connectedUser'])){
?>

<div class="content">
  <div class="container-fluid">
    <div class="tab-bord">
      <h1 class="mb-0">Espace commande #<?= htmlspecialchars($idCommande) ?></h1>
    </div>

    <div class="container mt-5">
      <a href="/GestionStock_Boutique_FBLD/public/routeurs/commande.php" class="btn btn-dark mb-4">
        🔙 Retour
      </a>
      <?php if ($detail) { ?>
        <div class="card shadow">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead class="bg-dark text-white">
                  <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix unitaire</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $totalGeneral = 0;
                  foreach ($detail as $item) { 
                      $totalGeneral += $item['total'];
                  ?>
                    <tr>
                      <td><?= htmlspecialchars($item['nom']) ?></td>
                      <td><?= htmlspecialchars($item['quantite']) ?></td>
                      <td><?= number_format($item['prix'], 2, ',', ' ') ?> F</td>
                      <td><?= number_format($item['total'], 2, ',', ' ') ?> F</td>
                    </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr class="fw-bold">
                    <td colspan="3" class="text-end">Total général</td>
                    <td><?= number_format($totalGeneral, 2, ',', ' ') ?> F</td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <div class="alert alert-warning">⚠️ Aucun produit trouvé pour cette commande.</div>
      <?php } ?>
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