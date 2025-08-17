<?php 
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../templates/sidebar.php';

if(isset($_SESSION['connectedUser'])){
?>

<div class="content">
  <div class="container-fluid">

    <div class="tab-bord">
      <h1 class="mb-0">Gestion des Commandes</h1>
    </div>

    <div class="container mt-5">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Ajouter une commande</h2>
        <a href="/GestionStock_Boutique_FBLD/public/routeurs/commande.php" class="btn btn-dark">
          🔙 Retour
        </a>
      </div>
    </div>

    <form action="/GestionStock_Boutique_FBLD/public/routeurs/commande.php?action=add" 
        method="POST" class="p-4 shadow rounded bg-white" 
        style="max-width: 800px; margin: auto; margin-top: 20px">

        <!-- Message -->
        <?php if (!empty($message)): ?>
            <div class="alert alert-<?= $messageClass ?> text-center">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <!-- Sélection Client -->
        <div class="mb-3">
            <label for="idClient" class="form-label">Client</label>
            <select id="idClient" name="idClient" class="form-select" required>
                <option value="">-- Sélectionner un client --</option>
                <?php foreach ($clients as $c): ?>
                    <option value="<?= $c['id'] ?>">
                        <?= htmlspecialchars($c['nom']) ?> (<?= htmlspecialchars($c['email']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Sélection Produits -->
        <div class="mb-3">
            <label class="form-label">Produits et quantités</label>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix Unitaire</th>
                        <th>Stock</th>
                        <th>Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['nom']) ?></td>
                        <td><?= number_format($p['prix'], 2, ',', ' ') ?> F</td>
                        <td><?= $p['stock'] ?></td>
                        <td>
                            <input type="number" name="produits[<?= $p['id'] ?>]" 
                                    min="0" max="<?= $p['stock'] ?>" 
                                    class="form-control" value="0">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Bouton -->
        <button type="submit" class="btn btn-dark w-100">Enregistrer la commande</button>
    </form>
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