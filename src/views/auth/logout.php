<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déconnexion</title>
    <link href="/GestionStock_FBL/asset/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
        <h4 class="text-center mb-3">Voulez-vous vous déconnecter ?</h4>
        <form action="/GestionStock_Boutique_FBLD/public/routeurs/auth.php?action=logout" method="POST" class="text-center">
            <button type="submit" name="confirm" value="oui" class="btn btn-danger w-100 mb-2">Oui</button>
            <button type="submit" name="confirm" value="non" class="btn btn-secondary w-100">Non</button>
        </form>
    </div>
</div>
