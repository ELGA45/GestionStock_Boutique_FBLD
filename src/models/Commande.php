<?php
require_once __DIR__ . '/BaseModel.php';

class Commande extends BaseModel {
    // Ajouter une commande
    public function create($idClient, $produits)
    {
        try {
            $this->conn->beginTransaction();

            // Vérifier si le client existe
            $stmtCheckClient = $this->conn->prepare("SELECT id FROM client WHERE id = ?");
            $stmtCheckClient->execute([$idClient]);
            if (!$stmtCheckClient->fetchColumn()) {
                return "⚠️ Client introuvable";
            }

            // Insérer la commande
            $sql = "INSERT INTO commande(idClient, dateCommande, etat) VALUES (?, NOW(), 'en attente')";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$idClient]);
            $idCommande = $this->conn->lastInsertId();

            // Ajouter les produits et mettre à jour le stock
            $sqlProd = "INSERT INTO commande_produit(idCommande, idProduit, quantite) VALUES (?, ?, ?)";
            $stmtProd = $this->conn->prepare($sqlProd);

            $sqlUpdateStock = "UPDATE produit SET stock = stock - ? WHERE id = ? AND stock >= ?";
            $stmtStock = $this->conn->prepare($sqlUpdateStock);

            foreach ($produits as $idProduit => $quantite) {
                if ($quantite <= 0) continue; // ignorer les produits non commandés

                // Vérifier si le produit existe et stock suffisant
                $stmtCheckProd = $this->conn->prepare("SELECT stock FROM produit WHERE id = ?");
                $stmtCheckProd->execute([$idProduit]);
                $stockActuel = $stmtCheckProd->fetchColumn();

                if ($stockActuel === false) {
                    $this->conn->rollBack();
                    return "⚠️ Produit ID {$idProduit} introuvable";
                }

                if ($stockActuel < $quantite) {
                    $this->conn->rollBack();
                    return "⚠️ Stock insuffisant pour le produit ID {$idProduit}";
                }

                // Ajouter à commande_produit
                $stmtProd->execute([$idCommande, $idProduit, $quantite]);

                // Diminuer le stock
                $stmtStock->execute([$quantite, $idProduit, $quantite]);
            }


            $this->conn->commit();
            return "✅ Commande ajoutée et stock mis à jour avec succès";
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return "❌ Erreur lors de l'ajout : " . $e->getMessage();
        }
    }

    // Liste toutes les commandes
    public function AllCommandes()
    {
        $sql = "SELECT c.id, cl.nom AS client, c.dateCommande, c.etat
                FROM commande c
                JOIN client cl ON cl.id = c.idClient
                ORDER BY c.dateCommande DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function commandeById($id)
    {
        $sql = "SELECT c.id AS idClient, cl.nom AS client, c.dateCommande, c.etat
                FROM commande c
                JOIN client cl ON cl.id = c.idClient
                WHERE c.id = ?";
        return $this->query($sql, [$id])->fetch(PDO::FETCH_ASSOC);
    }

    // Détails d'une commande
    public function DetailsCommande($idCommande)
    {
        $sql = "SELECT p.nom  , cp.quantite, p.prix, (cp.quantite * p.prix) AS total
                FROM commande_produit cp
                JOIN produit p ON p.id = cp.idProduit
                WHERE cp.idCommande = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idCommande]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function UpdateCommande($idCommande, $idClient, $produits) {
    try {
        $this->conn->beginTransaction();

        // 1. Remettre le stock des anciens produits
        $sqlStockRetour = "UPDATE produit p 
                          JOIN commande_produit cp ON p.id = cp.idProduit 
                          SET p.stock = p.stock + cp.quantite 
                          WHERE cp.idCommande = ?";
        $stmtStockRetour = $this->conn->prepare($sqlStockRetour);
        $stmtStockRetour->execute([$idCommande]);

        // 2. Supprimer les anciens produits de la commande
        $sqlDeleteProd = "DELETE FROM commande_produit WHERE idCommande = ?";
        $stmtDel = $this->conn->prepare($sqlDeleteProd);
        $stmtDel->execute([$idCommande]);


        // Mettre à jour le client
        $sqlUpdateCmd = "UPDATE commande SET idClient = ? WHERE id = ?";
        $stmtUpdateCmd = $this->conn->prepare($sqlUpdateCmd);
        $stmtUpdateCmd->execute([$idClient, $idCommande]);

        // Ajouter les nouveaux produits
        $sqlProd = "INSERT INTO commande_produit(idCommande, idProduit, quantite) VALUES (?, ?, ?)";
        $stmtProd = $this->conn->prepare($sqlProd);

        // Diminuer le stock pour les nouveaux produits
        $sqlUpdateStock = "UPDATE produit SET stock = stock - ? WHERE id = ?";
        $stmtStock = $this->conn->prepare($sqlUpdateStock);

        foreach ($produits as $p) {
            $stmtProd->execute([$idCommande, $p['idProduit'], $p['quantite']]);
            $stmtStock->execute([$p['quantite'], $p['idProduit']]);
        }

        $this->conn->commit();
        return "✅ Commande modifiée avec succès";
    } catch (PDOException $e) {
        $this->conn->rollBack();
        return "❌ Erreur lors de la modification : " . $e->getMessage();
    }
}

    // Modifier état d'une commande
    public function UpdateEtat($idCommande, $nouvelEtat)
    {
        $sql = "UPDATE commande SET etat = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nouvelEtat, $idCommande]);
    }

    // Supprimer une commande
    public function DeleteCommande($idCommande)
    {
        try {
            // Vérifier l'état
            $sqlEtat = "SELECT etat FROM commande WHERE id = ?";
            $stmtEtat = $this->conn->prepare($sqlEtat);
            $stmtEtat->execute([$idCommande]);
            $etat = $stmtEtat->fetchColumn();

            $this->conn->beginTransaction();

            // Si livrée → on remet le stock
            if ($etat !== 'livrée') {
                $sqlSelect = "SELECT idProduit, quantite FROM commande_produit WHERE idCommande = ?";
                $stmtSelect = $this->conn->prepare($sqlSelect);
                $stmtSelect->execute([$idCommande]);
                $produits = $stmtSelect->fetchAll(PDO::FETCH_ASSOC);

                $sqlUpdateStock = "UPDATE produit SET stock = stock + ? WHERE id = ?";
                $stmtStock = $this->conn->prepare($sqlUpdateStock);
                foreach ($produits as $p) {
                    $stmtStock->execute([$p['quantite'], $p['idProduit']]);
                }
            }

            // Supprimer commande_produit
            $sqlDeleteProd = "DELETE FROM commande_produit WHERE idCommande = ?";
            $stmtDelProd = $this->conn->prepare($sqlDeleteProd);
            $stmtDelProd->execute([$idCommande]);

            // Supprimer la commande
            $sqlDeleteCmd = "DELETE FROM commande WHERE id = ?";
            $stmtDelCmd = $this->conn->prepare($sqlDeleteCmd);
            $stmtDelCmd->execute([$idCommande]);

            $this->conn->commit();
            return "✅ Commande supprimée avec succès";
        } catch (PDOException $e) {
            $this->conn->rollBack();
            return "❌ Erreur lors de la suppression : " . $e->getMessage();
        }
    }
}
