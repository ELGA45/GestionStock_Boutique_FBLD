<?php 
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../templates/sidebar.php';

if(isset($_SESSION['connectedUser'])){
?>

<div class="content">
  <div class="container-fluid">
    <div class="container mt-5">
        <div class="card p-4 shadow" style="max-width: 500px; margin: auto;">
            <h4 class="text-center mb-4">Voulez-vous supprimer ce produit ?</h4>
            <p class="text-center"><strong><?= htmlspecialchars($infoUser['nom']) ?></strong></p>

            <form action="/GestionStock_Boutique_FBLD/public/routeurs/utilisateur.php?action=delete" method="POST">
              <input type="hidden" name="id" value="<?= htmlspecialchars($infoUser['id']) ?>">
                <div class="d-grid gap-2">
                    <button type="submit" name="confirm" value="oui" class="btn btn-danger">Oui</button>
                    <button type="submit" name="confirm" value="non" class="btn btn-secondary">Non</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>

<?php 
    include __DIR__ . '/../templates/footer.php'; 
  }
  else {
    header('Location:/GestionStock_Boutique_FBLD/public/routeurs/auth.php?loginForm');
        exit();
  }
?>