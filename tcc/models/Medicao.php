<?php  
require_once(__DIR__ . '/../config/Database.php');

class Medicao {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getUltimaMedicao() {
        $sql = "SELECT * FROM tbl_medicoes ORDER BY data_hora DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTodasMedicoes() {
        $sql = "SELECT * FROM tbl_medicoes ORDER BY data_hora ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUltimasMedicoes($limite = 20) {
        $sql = "SELECT * FROM tbl_medicoes ORDER BY data_hora DESC LIMIT :limite";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
        $stmt->execute();
        return array_reverse($stmt->fetchAll(PDO::FETCH_ASSOC));
    }
}
