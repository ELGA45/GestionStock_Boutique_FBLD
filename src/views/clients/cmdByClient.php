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
        <h2>Liste des commandes du <?= htmlspecialchars($infoClient['nom'] ) ?> (<?= htmlspecialchars($infoClient['email'] ) ?>)</h2>
        <a href="/GestionStock_Boutique_FBLD/public/routeurs/client.php" class="btn btn-dark">
          🔙 Retour
        </a>
      </div>

      <div class="card shadow">
        <div class="card-body">
          <?php if ($cmds) { ?>
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead class="table-dark">
                  <tr class="bg-dark text-white" >
                    <th>#</th>
                    <th>Date</th>
                    <th>État</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($cmds as $cmd) { ?>
                    <tr>
                      <td><?= htmlspecialchars($cmd['idCmd']) ?></td>
                      <td><?= htmlspecialchars($cmd['dateCommande']) ?></td>
                      <td>
                        <?php if ($cmd['etat'] !== 'livrée') { ?>
                          <a href="/GestionStock_Boutique_FBLD/public/routeurs/commande.php?action=editEtatForm&id=<?= $cmd['idCmd'] ?>" 
                              class="btn btn-sm btn-warning">
                              <?= htmlspecialchars($cmd['etat']) ?>
                          </a>
                        <?php } else { ?>
                          <span class="badge bg-success"><?= htmlspecialchars($cmd['etat']) ?></span>
                        <?php } ?>
                      </td>
                      <td>
                        <a href="/GestionStock_Boutique_FBLD/public/routeurs/commande.php?action=detail&id=<?= $cmd['idCmd'] ?>"
                          class="btn btn-sm btn-info">
                          📄 Détails
                        </a>
                        <a href="/GestionStock_Boutique_FBLD/public/routeurs/commande.php?action=editForm&id=<?= $cmd['idCmd'] ?>"
                          class="btn btn-sm btn-warning">
                          ✏️ Modifier
                        </a>
                        <a href="/GestionStock_Boutique_FBLD/public/routeurs/commande.php?action=deleteForm&id=<?= $cmd['idCmd'] ?>" 
                            class="btn btn-sm btn-danger">
                            🗑️ Supprimer
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } else { ?>
            <div class="alert alert-warning m-3">Aucune commande trouvée.</div>
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