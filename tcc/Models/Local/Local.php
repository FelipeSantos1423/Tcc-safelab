<?php

class Local {
    private $id;
    private $locais;
    private $descricao;

    public function __construct($id = null, $locais = null, $descricao = null, $criado_em = null) {
        $this->id = $id;
        $this->locais = $locais;
        $this->descricao = $descricao;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getLocais() {
        return $this->locais;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setLocais($locais) {
        $this->locais = $locais;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

}
