<?php
require_once __DIR__ . '/Leitura.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../Dispositivo/DispositivoDAO.php';

class LeituraDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Lista todas as leituras, junto com o nome do dispositivo
    public function listarTodas() {
        $query = "SELECT l.id, l.tbl_dispositivos_id, d.nome AS dispositivo, l.temperatura, l.umidade, l.luz, l.ruido, l.data_registro
                  FROM tbl_leituras l
                  JOIN tbl_dispositivos d ON l.tbl_dispositivos_id = d.id
                  ORDER BY l.data_registro DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lista todas as leituras de um dispositivo específico
    public function listarPorDispositivo($dispositivoId) {
        $query = "SELECT l.id, l.tbl_dispositivos_id, d.nome AS dispositivo, l.temperatura, l.umidade, l.luz, l.ruido, l.data_registro
                  FROM tbl_leituras l
                  JOIN tbl_dispositivos d ON l.tbl_dispositivos_id = d.id
                  WHERE l.tbl_dispositivos_id = :id
                  ORDER BY l.data_registro DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $dispositivoId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lista os dispositivos com suas leituras mais recentes
    public function listarUltimasPorDispositivo() {
        $query = "SELECT l.*
                  FROM tbl_leituras l
                  INNER JOIN (
                      SELECT tbl_dispositivos_id, MAX(data_registro) AS ultima
                      FROM tbl_leituras
                      GROUP BY tbl_dispositivos_id
                  ) ult ON l.tbl_dispositivos_id = ult.tbl_dispositivos_id AND l.data_registro = ult.ultima
                  ORDER BY l.tbl_dispositivos_id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserir($dados) {
        $query = "INSERT INTO tbl_leituras 
            (tbl_dispositivos_id, temperatura, umidade, luz, ruido, data_registro) 
            VALUES (:dispositivo, :temp, :umid, :luz, :ruido, :data)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':dispositivo', $dados['tbl_dispositivos_id'], PDO::PARAM_INT);
        $stmt->bindParam(':temp', $dados['temperatura']);
        $stmt->bindParam(':umid', $dados['umidade']);
        $stmt->bindParam(':luz', $dados['luz']);
        $stmt->bindParam(':ruido', $dados['ruido']);
        $stmt->bindParam(':data', $dados['data_registro']);
        return $stmt->execute();
    }

}
?>
