<?php
require_once __DIR__ . '/Local.php';
require_once(__DIR__ . '/../../config/database.php');

class LocalDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Listar todos os locais
    public function listarTodos() {
        $query = "SELECT * FROM tbl_locais ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar local pelo ID
    public function buscarPorId($id) {
        $query = "SELECT * FROM tbl_locais WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Adicionar novo local
    public function adicionar($locais, $descricao) {
        $query = "INSERT INTO tbl_locais (locais, descricao) VALUES (:locais, :descricao)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':locais', $locais);
        $stmt->bindParam(':descricao', $descricao);
        return $stmt->execute();
    }

    // Atualizar locais
    public function atualizar($id, $locais, $descricao) {
        $query = "UPDATE tbl_locais SET locais = :locais, descricao = :descricao WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':locais', $locais);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Excluir locais
  public function excluir($id) {
    $query = "DELETE FROM tbl_locais WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

}
