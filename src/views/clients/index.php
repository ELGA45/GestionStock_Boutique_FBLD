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
        <h2>Liste des clients</h2>
        <a href="/GestionStock_Boutique_FBLD/public/routeurs/client.php?action=addForm" class="btn btn-dark">
          ➕ Ajouter un client
        </a>
      </div>

      <div class="card shadow">
        <div class="card-body p-0">
          <?php if($clients){ ?>
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead class="table-dark">
                  <tr class="bg-dark text-white" >
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($clients as $client) { ?>
                    <tr>
                      <td><?= htmlspecialchars($client['nom']) ?></td>
                      <td><?= htmlspecialchars($client['email']) ?></td>
                      <td><?= htmlspecialchars($client['téléphone']) ?></td>
                      <td>
                        <?php echo "<a href='/GestionStock_Boutique_FBLD/public/routeurs/client.php?action=editForm&id=".$client['id']."' class='btn btn-sm btn-warning'>
                                      ✏️ Modifier
                                    </a>&nbsp";
                              echo "<a href='/GestionStock_Boutique_FBLD/public/routeurs/client.php?action=deleteForm&id=".$client['id']."' class='btn btn-sm btn-danger'>
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
            <div class="alert alert-warning m-3">Aucun client trouvé.</div>
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