<?php include __DIR__ . '/../templates/header.php'; 
      include __DIR__ . '/../templates/sidebar.php';
?>

<div class="content">
  <div class="container-fluid">
    <div class="container mt-5">
        <div class="card p-4 shadow" style="max-width: 500px; margin: auto;">
            <h4 class="text-center mb-4">Voulez-vous supprimer ce produit ?</h4>
            <p class="text-center"><strong><?= htmlspecialchars($infoPrdt['nom']) ?></strong></p>

            <form action="/GestionStock_Boutique_FBLD/public/routeurs/produit.php?action=delete" method="POST">
              <input type="hidden" name="id" value="<?= htmlspecialchars($infoPrdt['id']) ?>">
                <div class="d-grid gap-2">
                    <button type="submit" name="confirm" value="oui" class="btn btn-danger">Oui</button>
                    <button type="submit" name="confirm" value="non" class="btn btn-secondary">Non</button>
                </div>
            </form>
        </div>
    </div>
  </div>
</div>
<?php include __DIR__ . '/../templates/footer.php'; ?>
