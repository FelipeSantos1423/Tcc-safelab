<?php

class Usuario {
    private $id;
    private $nomeC;
    private $email;
    private $senha_hash;

    public function __construct($data = null) {
        if ($data) {
            $this->id = $data['id'] ?? null;
             $this->nomeC = $data['nomeC'] ?? null;
            $this->email = $data['email'] ?? null;
            $this->senha_hash = $data['senha_hash'] ?? null;
        }
    }

    // Getters e Setters
    public function getId() { return $this->id; }
    public function getNomeC() { return $this->nomeC; }
    public function getEmail() { return $this->email; }
    public function getSenhaHash() { return $this->senha_hash; }

    public function setNomeC($nomeC) { $this->nomeC = $nomeC; }
    public function setEmail($email) { $this->email = $email; }
    public function setSenhaHash($senha_hash) { $this->senha_hash = $senha_hash; }
}
?>