<?php
require_once __DIR__ . '/BaseModel.php';

class Categorie extends BaseModel {

    public function getAll() {
        $sql = "SELECT * FROM categorie ORDER BY nom ASC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
