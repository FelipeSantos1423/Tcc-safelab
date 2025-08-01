<?php
require_once 'Usuario.php';
require_once '../config/Database.php';

class UsuarioDAO {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Busca um usuário pelo email
    public function buscarPorEmail($email) {
        $query = "SELECT * FROM tbl_usuario WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Valida login: retorna objeto Usuario ou null
    public function validarLogin($email, $senha) {
        $usuarioData = $this->buscarPorEmail($email);
        if ($usuarioData && password_verify($senha, $usuarioData['senha_hash'])) {
            return new Usuario($usuarioData);
        }
        return null;
    }

    // Retorna todos os tipos de usuário da tabela tipo_usuario
public function listarTiposUsuarios() {
    $query = "SELECT id, tipo FROM tbl_tipo_usuario ORDER BY tipo";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    // Cria um novo usuário no banco
   public function criarUsuario(Usuario $usuario) {
    $query = "INSERT INTO tbl_usuario (nomeC, email, senha_hash, tbl_tipo_usuario_id) 
              VALUES (:nomeC, :email, :senha_hash, :tbl_tipo_usuario_id)";
    try {
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':nomeC', $usuario->getNomeC());
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->bindValue(':senha_hash', $usuario->getSenhaHash());
        $stmt->bindValue(':tbl_tipo_usuario_id', $usuario->getTipo(), PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    } catch (PDOException $e) {
        throw new Exception("Erro ao inserir usuário: " . $e->getMessage());
    }
}


    // Busca usuário pelo ID e retorna objeto Usuario ou null
    public function buscarPorId($id) {
        $query = "SELECT * FROM tbl_usuario WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            return new Usuario($data);
        }
        return null;
    }

    // Atualiza só o email do usuário pelo ID
    public function atualizarEmail($id, $email) {
        $query = "UPDATE tbl_usuario SET email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Atualiza email e senha do usuário pelo ID
    public function atualizarEmailSenha($id, $email, $senha) {
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $query = "UPDATE tbl_usuario SET email = :email, senha_hash = :senha_hash WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha_hash', $senha_hash);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Exclui usuário pelo ID
    public function excluir($id) {
        $query = "DELETE FROM tbl_usuario WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
