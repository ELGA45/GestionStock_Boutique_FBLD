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
        <h2>Liste des produits</h2>
        <a href="/GestionStock_Boutique_FBLD/public/routeurs/produit.php?action=addForm" class="btn btn-dark">
          ➕ Ajouter un produit
        </a>
      </div>

      <div class="card shadow">
        <div class="card-body p-0">
          <?php if($produits){ 
            $nmr = 0;
          ?>
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead class="table-dark">
                  <tr class="bg-dark text-white" >
                    <th>Numéro</th>
                    <th>Libellé</th>
                    <th>Prix (FCFA)</th>
                    <th>Stock</th>
                    <th>Categorie</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($produits as $prdt) { 
                    $nmr++;
                  ?>
                    
                    <tr>
                      <td><?= $nmr ?></td>
                      <td><?= htmlspecialchars($prdt['nom']) ?></td>
                      <td><?= number_format($prdt['prix'], 2, ',', ' ') ?></td>
                      <td><?= number_format($prdt['stock']) ?></td>
                      <td><?= htmlspecialchars($prdt['categorie_nom']) ?></td>
                      <td>
                        <?php echo "<a href='/GestionStock_Boutique_FBLD/public/routeurs/produit.php?action=editForm&id=".$prdt['id']."' class='btn btn-sm btn-warning'>
                                      ✏️ Modifier
                                    </a>&nbsp";
                              echo "<a href='/GestionStock_Boutique_FBLD/public/routeurs/produit.php?action=deleteForm&id=".$prdt['id']."' class='btn btn-sm btn-danger'>
                                      🗑️ Supprimer
                                    </a>";
                        ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } else { ?>
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
