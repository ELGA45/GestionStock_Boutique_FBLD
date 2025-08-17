<?php
require_once __DIR__ . '/../models/Commande.php';
require_once __DIR__ . '/../models/Client.php';
require_once __DIR__ . '/../models/Produit.php';

class CommandeController {

    // Afficher toutes les commandes
    public function index() {
        $commande = new Commande();
        $commandes = $commande->AllCommandes();
        include __DIR__ . '/../views/commandes/index.php';
    }

    public function info(){
        $commande = new Commande();
        $infoCmds = $commande->AllCommandes();
        return $infoCmds;
    }

    public function detail($idCommande){
      $detailCmd = new Commande;
      $detail = $detailCmd->DetailsCommande($idCommande);
      include __DIR__ . '/../views/commandes/detailCommande.php';
    }

    // Formulaire d'ajout
    public function addForm($message, $messageClass) {
        $client = new Client();
        $produit = new Produit();
        $clients = $client->getALL();
        $produits = $produit->getAll();
        include __DIR__ . '/../views/commandes/add.php';
    }

    // Ajout
    public function add() {
        $idClient = $_POST['idClient'] ?? null;
        $produits = $_POST['produits'] ?? []; // tableau de produits [idProduit, quantite]

        $commande = new Commande();
        $message = $commande->create($idClient, $produits);

        if (strpos($message, '✅') !== false) {
            $messageClass = "success";
        } 
        elseif (strpos($message, '❌') !== false) {
            $messageClass = "danger";
        }
        else {
            $messageClass = "warning";
        }

        header("Location: /GestionStock_Boutique_FBLD/public/routeurs/commande.php?m=".$message."&mc=".$messageClass);
    }

    // Formulaire d'édition
    public function editForm($idCommande, $message, $messageClass) {
        $commande = new Commande();
        $client = new Client();
        $produit = new Produit();

        $clients = $client->getALL();
        $produits = $produit->getALL();
        $details = $commande->DetailsCommande($idCommande);
        $infoCmd = $commande->commandeById($idCommande);
        if($infoCmd && $infoCmd['etat'] !== 'livrée'){
          include __DIR__ . '/../views/commandes/edit.php';
        }
        else {
            header("Location: /GestionStock_Boutique_FBLD/public/routeurs/commande.php");
        }
    }

    // Modifier une commande
    public function update($idCommande) {
        $idClient = $_POST['idClient'] ?? null;
        $prdt = $_POST['produit'] ?? null;
        $qte = $_POST['quantite'] ?? null;
        $produits = [];

        if (!empty($_POST['produit']) && !empty($_POST['quantite'])) {
            foreach ($prdt as $i => $idProduit) {
                if (!empty($idProduit) && !empty($qte[$i])) {
                    $produits[] = [
                        'idProduit' => $idProduit,
                        'quantite' => $qte[$i]
                    ];
                }
            }
        }

        $commande = new Commande();
        $message = $commande->UpdateCommande($idCommande, $idClient, $produits);

        if (strpos($message, '✅') !== false) {
            $messageClass = "success";
        } 
        elseif (strpos($message, '❌') !== false) {
            $messageClass = "danger";
        }
        else {
            $messageClass = "warning";
        }

        header("Location: /GestionStock_Boutique_FBLD/public/routeurs/commande.php?id=".$idCommande."m=".$message."&mc=".$messageClass);
    }

    public function editEtatForm($idCommande){
      $commande = new Commande();
      $infoCmd = $commande->commandeById($idCommande);
      if($infoCmd && $infoCmd['etat'] !== 'livrée'){
          include __DIR__ . '/../views/commandes/editEtat.php';
      }
      else {
          header("Location: /GestionStock_Boutique_FBLD/public/routeurs/commande.php");
      }
    }

    // Modifier état
    public function updateEtat($idCommande) {
        $etat = $_POST['etat'] ?? null;

        $commande = new Commande();
        $message = $commande->UpdateEtat($idCommande, $etat);

        header("Location: /GestionStock_Boutique_FBLD/public/routeurs/commande.php");
    }

    // Confirmation suppression
    public function deleteForm($idCommande) {
        $commande = new Commande();
        $infoCmd = $commande->commandeById($idCommande);
        if($infoCmd && $infoCmd['etat'] !== 'livrée'){
          include __DIR__ . '/../views/commandes/delete.php';
        }
        else {
          header("Location: /GestionStock_Boutique_FBLD/public/routeurs/commande.php");
        }
    }

    // Supprimer
    public function delete($idCommande, $confirm) {
        if ($confirm === 'oui') {
            $commande = new Commande();
            $message = $commande->DeleteCommande($idCommande);
        } else {
            $message = "❌ Suppression annulée";
        }

        header("Location: /GestionStock_Boutique_FBLD/public/routeurs/commande.php?m=" . urlencode($message) . "&mc=success");
    }
}