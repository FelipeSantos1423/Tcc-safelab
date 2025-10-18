<?php
require_once __DIR__ . '/Dispositivo.php';
require_once __DIR__ . '/../../config/database.php';

class DispositivoDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function listarTodos() {
        $query = "SELECT d.id, d.nome, d.codigo_esp, d.ativo, d.criado_em, d.tbl_locais_id,
                         l.locais AS nome_local
                  FROM tbl_dispositivos d
                  JOIN tbl_locais l ON d.tbl_locais_id = l.id
                  ORDER BY d.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id) {
        $query = "SELECT * FROM tbl_dispositivos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function adicionar($nome, $codigo_esp, $ativo, $tbl_locais_id) {
        $query = "INSERT INTO tbl_dispositivos (nome, codigo_esp, ativo, tbl_locais_id) 
                  VALUES (:nome, :codigo_esp, :ativo, :tbl_locais_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':codigo_esp', $codigo_esp);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_INT);
        $stmt->bindParam(':tbl_locais_id', $tbl_locais_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function atualizar($id, $nome, $codigo_esp, $ativo, $tbl_locais_id) {
        $query = "UPDATE tbl_dispositivos 
                  SET nome = :nome, codigo_esp = :codigo_esp, ativo = :ativo, tbl_locais_id = :tbl_locais_id
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':codigo_esp', $codigo_esp);
        $stmt->bindParam(':ativo', $ativo, PDO::PARAM_INT);
        $stmt->bindParam(':tbl_locais_id', $tbl_locais_id, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function excluir($id) {
        $query = "DELETE FROM tbl_dispositivos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function buscarPorCodigo($codigoEsp) {
    try {
        $sql = "SELECT * FROM tbl_dispositivos WHERE codigo_esp = :codigo_esp LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':codigo_esp', $codigoEsp);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao buscar dispositivo por código: " . $e->getMessage());
        return false;
    }
}

}
?>
