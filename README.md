# # Sistema de login e Cadastro

# Modelo de Documentação para Aplicação PHP com MySQL
## 1 Introdução 
- *Nome do Projeto:* Sistema de login e Cadastro
- *Descrição:* Este projeto tem como objetivo criar um sistema de cadastro e login com dados salvos no banco de dados. 
- *Tecnologias Utilizadas:* PHP, MySQL, CSS, Xampp.
- *Autor(es):*   Felipe dos Santos Pinto,
                 Henrique dos Santos Pinto.
- *Data de início:* 08/06/2025 

## 2 Estrutura do Projeto 

etec-login-poo/
│
├── assets/
│ └── style.css # Estilo da interface
│ └── exibe.css # Estilo da interface da página de exibição
│
├── config/
│ ├── Database.php # Conexão com banco (PDO)
│ └── README.md
│
├── models/
│ ├── Usuario.php # Classe de entidade
│ └── UsuarioDAO.php # Classe para acesso ao banco (Data Access Object)
│
├── public/
│ ├── cadastro.php # Tela de cadastro
│ ├── exibe-dados.php # Tela de exibição
│ ├── login.php # Tela de login
│ ├── process_cadastro.php # Processamento do cadastro
│ └── process_login.php # Processamento do login
│
├── utils/
│ └── Sanitizacao.php # Funções de sanitização e validação
│
└── README.md
README.md
diagrama_db.mwb
dump_db_23-06.sql

## 3 Configuração do Ambiente 
### *Requisitos* 
- Servidor Apache 
- PHP 8.2.0 
- MySQL  8.0.41.

### *Instalação* 

1. Clone o repositório: 
 bash
 git clone https://github.com/FelipeSantos1423/Proj_fabiano.git
 cd Controle-de-Estoque
 
2. Instale as dependências: 
 bash;
 
3. Configure o banco de dados: 
 - Crie o banco no MySQL 
 - Execute o Dump SQL;
 
 - Configure as credenciais no conexao.php 
4. Inicie o servidor: 
bash
 php -S localhost:8000 -t public

## 4 Estrutura do Banco de Dados 
-- MySQL Workbench Synchronization
-- Generated: 2025-06-08 20:02
-- Model: New Model
-- Version: 1.0
-- Project: Sistema de cadastro e login
-- Author: Henrique

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS cadastro_db DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS cadastro_db.usuario (
  id INT(11) NOT NULL AUTO_INCREMENT,
  email VARCHAR(100) NOT NULL,
  senha_hash VARCHAR(255) NOT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX email_UNIQUE (email ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

## 5 Segurança e Boas Práticas 
- Validação e sanitização de entrada de dados
- 
## 6 Testes 
- Testes manuais de casos de uso.
- 
## 7 Deploy e Hospedagem 
### Configuração no Servidor 
1. Configure um servidor Apache/Nginx 
2. Defina permissões corretas nas pastas 
3. Configure um sistema de logs para monitoramento 
### Banco de Dados 
- Backup regular do banco (mysqldump) 
- Indexação para melhor desempenho
