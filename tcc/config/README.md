# Explicação Detalhada:

##  1. Classe *Database*:

**Objetivo**: Centralizar a lógica de conexão com o banco de dados.

**Encapsulamento**: As configurações (host, nome do banco, etc.) são privadas para evitar acesso externo direto.

## 2. **Propriedades**:

`$host`: Endereço do servidor (geralmente localhost em ambiente local).
`$db_name`: Nome do banco de dados (sistema_login).
`$username` e `$password`: Credenciais de acesso (usuário root com senha root é comum em ambientes de desenvolvimento).
`$conn`: Armazena o objeto PDO após a conexão.

## 3. **Método** `getConnection()`:

**Reinicialização**: `$this->conn = null` garante que não haja conexões antigas.

 - **Bloco `try`**:
-> Cria uma conexão PDO usando a string de conexão (`mysql:host=...;dbname=...`).
-> Define `PDO::ERRMODE_EXCEPTION` para que erros gerem exceções (facilita a depuração).

- **Bloco `catch`**:
-> Captura exceções do tipo `PDOException` (erros de conexão ou configuração).
-> `die()` interrompe a execução e exibe a mensagem de erro (útil para desenvolvimento, mas evite em produção).

**Retorno**: Devolve a conexão PDO ativa para ser utilizada em consultas.

## **Boas Práticas**:

**Segurança**: Usar PDO com *prepared statements* previne SQL *Injection*.

**Tratamento de Erros**: Exceções permitem identificar problemas rapidamente.

**Reusabilidade**: A classe pode ser instanciada em qualquer parte do sistema para obter a conexão.


## **O que é PDO?**

 - **Camada de Abstração de Banco de Dados**:

-> O PDO permite interagir com diferentes bancos de dados (MySQL, PostgreSQL, SQLite, etc.) usando uma sintaxe única. Isso significa que, se você migrar de MySQL para outro banco no futuro, apenas a string de conexão precisará ser ajustada, e não todo o código de interação com o banco.

**Orientado a Objetos**:
O PDO é uma classe nativa do PHP, e sua utilização segue o paradigma de orientação a objetos, tornando o código mais organizado e moderno.