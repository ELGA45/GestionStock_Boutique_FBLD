<?php 
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../templates/sidebar.php';

if(isset($_SESSION['connectedUser'])){
?>

<div class="content">
  <div class="container-fluid">
    <div class="tab-bord">
      <h1 class="mb-0">Espace Catégorie</h1>
    </div>
    <div class="container mt-5">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des Catégorie</h2>
        <a href="/GestionStock_Boutique_FBLD/public/routeurs/categorie.php?action=addForm" class="btn btn-dark">
          ➕ Ajouter une Catégorie
        </a>
      </div>

      <div class="card shadow">
        <div class="card-body">
          <?php if($categories){ ?>
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead class="table-dark">
                  <tr class="bg-dark text-white" >
                    <th>#</th>
                    <th>Libellé</th>
                    <th>Nombre de produits</th>
                    <th>Produits</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($categories as $ctg) { ?>
                    <tr>
                      <td><?= htmlspecialchars($ctg['id']) ?></td>
                      <td><?= htmlspecialchars($ctg['nom']) ?></td>
                      <td><?= htmlspecialchars($ctg['nbr_prdt']) ?></td>
                      <td> <?php echo "<a href='/GestionStock_Boutique_FBLD/public/routeurs/categorie.php?action=prdtsByCtg&id=".$ctg['id']."' class='btn btn-sm btn-info'>
                                        🔍 Voir Produit
                                      </a>"
                            ?>
                      </td>
                      <td>
                        <?php echo "<a href='/GestionStock_Boutique_FBLD/public/routeurs/categorie.php?action=editForm&id=".$ctg['id']."' 
                                          class='btn btn-sm btn-warning'>
                                      ✏️ Modifier
                                    </a>&nbsp";
                              echo "<a href='/GestionStock_Boutique_FBLD/public/routeurs/categorie.php?action=deleteForm&id=".$ctg['id']."' class='btn btn-sm btn-danger'>
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
            <div class="alert alert-warning m-3">Aucun catégorie trouvé.</div>
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