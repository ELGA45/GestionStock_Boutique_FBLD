<?php
require_once __DIR__ . '/../../config/database.php';

class BaseModel {
    protected $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    protected function query($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
