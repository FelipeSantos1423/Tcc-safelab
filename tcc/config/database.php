<?php

// Classe responsável por gerenciar a conexão com o banco de dados
class Database {
    // Configurações do banco de dados (privadas para segurança)
    private $host = 'localhost';        // Endereço do servidor do banco de dados
    private $db_name = 'safelab_db'; // Nome do banco de dados a ser utilizado
    private $username = 'root';         // Usuário do banco de dados (padrão do MySQL)
    private $password = 'root';         // Senha do usuário (padrão em alguns ambientes de desenvolvimento)
    private $conn;                      // Variável que armazenará a conexão PDO

    // Método público para obter a conexão com o banco de dados
    public function getConnection() {
        // Reinicia a conexão para evitar conflitos
        $this->conn = null;

        try {
            // Tenta criar uma nova conexão PDO com os parâmetros definidos
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}", // String de conexão MySQL
                $this->username,                                   // Usuário do banco
                $this->password                                    // Senha do usuário
            );

            // Configura o modo de erro do PDO para lançar exceções (melhor para debug)
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) { // Captura exceções relacionadas ao PDO
            // Em caso de erro, exibe uma mensagem e encerra a execução
            die("Erro na conexão: " . $e->getMessage());
        }

        // Retorna a conexão estabelecida para ser usada em outras partes do sistema
        return $this->conn;
    }
}