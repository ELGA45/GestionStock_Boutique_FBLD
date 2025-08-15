<?php
require_once __DIR__ . '/../models/Client.php';

class ClientController {

    // Liste des clients
    public function index() {
        $client = new Client();
        $clients = $client->getALL();
        include __DIR__ . '/../views/clients/index.php';
    }

    // Formulaire d'ajout
    public function addForm($message = '', $messageClass = '') {
        include __DIR__ . '/../views/clients/add.php';
    }

    // Ajout d'un client
    public function add() {
        $nom = $_POST['nom'] ?? '';
        $email = $_POST['email'] ?? '';
        $telephone = $_POST['telephone'] ?? '';

        $newClient = new Client();
        $clientExist = $newClient->getByEmail($email);

        if (!$clientExist) {
            $message = $newClient->create($nom, $email, $telephone);

            // Définir la classe de message
            if (strpos($message, '✅') !== false) {
                $messageClass = "success";
            } elseif (strpos($message, '❌') !== false) {
                $messageClass = "danger";
            }
        } else {
            $message = "⚠️ Cet email est déjà enregistré";
            $messageClass = "warning";
        }

        // Redirection après ajout
        header('Location: /GestionStock_Boutique_FBLD/public/routeurs/client.php?action=addForm&m='.$message.'&mc='.$messageClass);
        exit;
    }

    // Formulaire de modification
    public function editForm($id, $message = '', $messageClass = '') {
        $client = new Client();
        $infoClient = $client->getById($id);
        if ($infoClient) {
            include __DIR__ . '/../views/clients/edit.php';
        } else {
            $this->index(); // Retour à la liste
        }
    }

    // Mise à jour d'un client
    public function update($id) {
        $nom = $_POST['nom'] ?? '';
        $email = $_POST['email'] ?? '';
        $telephone = $_POST['telephone'] ?? '';

        $editClient = new Client();
        $message = $editClient->update($id, $nom, $email, $telephone);

        if (strpos($message, '✅') !== false) {
            $messageClass = "success";
        } elseif (strpos($message, '⛔') !== false || strpos($message, '❌') !== false) {
            $messageClass = "danger";
        }

        header('Location: /GestionStock_Boutique_FBLD/public/routeurs/client.php?action=editForm&m='.$message.'&mc='.$messageClass);
        exit;
    }

    // Formulaire de suppression
    public function deleteForm($id) {
        $client = new Client();
        $infoClient = $client->getById($id);
        if ($infoClient) {
            include __DIR__ . '/../views/clients/delete.php';
        } else {
            $this->index(); // Retour à la liste
        }
    }

    // Suppression d'un client
    public function delete($id, $confirm) {
        if ($confirm === 'oui') {
            $client = new Client();
            $client->DeleteClient($id);
        }
        $this->index(); // Retour à la liste
    }
}
