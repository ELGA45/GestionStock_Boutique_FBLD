<?php 
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../templates/sidebar.php';

if(isset($_SESSION['connectedUser'])){
  $roleUser = verifieRole($_SESSION['connectedUser']['rôle']);
?>

<div class="content">
  <div class="container-fluid">
    <div class="tab-bord">
      <h1 class="mb-0">Espace Utilisateur</h1>
    </div>
    <div class="container mt-5">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des utilisateurs</h2>
        <?php 
          if($roleUser){ ?>
            <a href="/GestionStock_Boutique_FBLD/public/routeurs/utilisateur.php?action=addForm" class="btn btn-dark">
              ➕ Ajouter un utilisateur
            </a>
        <?php } ?>
      </div>

      <div class="card shadow">
        <div class="card-body p-0">
          <?php if($users){ ?>
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead class="table-dark">
                  <tr class="bg-dark text-white" >
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Statut</th>
            <?php if($roleUser){ ?>
                    <th>Actions</th>
            <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($users as $user) { ?>
                    <tr>
                      <td><?= htmlspecialchars($user['nom']) ?></td>
                      <td><?= htmlspecialchars($user['email']) ?></td>
                      <td><?= htmlspecialchars($user['rôle']) ?></td>
              <?php if($roleUser){ ?>
                      <td>
                        <?php echo "<a href='/GestionStock_Boutique_FBLD/public/routeurs/utilisateur.php?action=updateStatut&id=".$user['id']."' class='btn btn-sm btn-info'>
                                      ".$user['statut']."
                                    </a>";
                    }
                    else { ?>
                        <td><?= htmlspecialchars($user['statut']) ?></td>
              <?php }
                    if($roleUser){ ?>
                      <td>
                        <?php echo "<a href='/GestionStock_Boutique_FBLD/public/routeurs/utilisateur.php?action=editForm&id=".$user['id']."' class='btn btn-sm btn-warning'>
                                      ✏️ Modifier
                                    </a>&nbsp";
                              echo "<a href='/GestionStock_Boutique_FBLD/public/routeurs/utilisateur.php?action=deleteForm&id=".$user['id']."' class='btn btn-sm btn-danger'>
                                      🗑️ Supprimer
                                    </a>";
                    } ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } else { ?>
            <div class="alert alert-warning m-3">Aucun utilisateur trouvé.</div>
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