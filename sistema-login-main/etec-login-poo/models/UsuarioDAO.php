<?php
// Importa as classes necessárias
require_once 'Usuario.php';      // Classe do modelo Usuario
require_once '../config/Database.php'; // Classe de conexão com o banco

class UsuarioDAO {
    private $conn; // Armazena a conexão PDO

    // Construtor: inicializa a conexão com o banco
    public function __construct() {
        $db = new Database(); // Cria uma instância da classe Database
        $this->conn = $db->getConnection(); // Obtém a conexão PDO
    }

    // Busca um usuário pelo email no banco de dados
    public function buscarPorEmail($email) {
        $query = "SELECT * FROM usuario WHERE email = :email"; // Query SQL com parâmetro nomeado
        $stmt = $this->conn->prepare($query); // Prepara a consulta para evitar SQL Injection
        $stmt->bindParam(':email', $email); // Vincula o parâmetro :email ao valor recebido
        $stmt->execute(); // Executa a consulta
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna o resultado como um array associativo
    }

    // Valida o login do usuário
    public function validarLogin($email, $senha) {
        $usuario = $this->buscarPorEmail($email); // Busca o usuário pelo email
        // Verifica se o usuário existe e se a senha fornecida corresponde ao hash armazenado
        if ($usuario && password_verify($senha, $usuario['senha_hash'])) {
            return new Usuario($usuario); // Retorna um objeto Usuario preenchido com os dados
        }
        return null; // Retorna null se as credenciais forem inválidas
    }

    public function criarUsuario(Usuario $usuario) {
        $query = "INSERT INTO usuario (nomeC, email, senha_hash) 
        VALUES (:nomeC, :email, :senha_hash)";
        
        try {
            $stmt = $this->conn->prepare($query);
            // Vincula os parâmetros do objeto Usuario
            $stmt->bindParam(':nomeC', $usuario->getNomeC()); 
            $stmt->bindParam(':email', $usuario->getEmail());
            $stmt->bindParam(':senha_hash', $usuario->getSenhaHash());
            
            // Executa a inserção
            if ($stmt->execute()) {
                // Retorna o ID gerado pelo banco
                return $this->conn->lastInsertId();
            }
            return false;
        } catch (PDOException $e) {
            // Em caso de erro, registra o erro e retorna false
            error_log("Erro ao inserir usuário: " . $e->getMessage());
            return false;
        }
    }
}
?>