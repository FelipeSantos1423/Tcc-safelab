<?php
class Dispositivo {
    private $id;
    private $nome;
    private $codigo_esp;
    private $ativo;
    private $tbl_locais_id;
    private $criado_em;

    public function __construct($id = null, $nome = null, $codigo_esp = null, $ativo = 1, $tbl_locais_id = null, $criado_em = null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->codigo_esp = $codigo_esp;
        $this->ativo = $ativo;
        $this->tbl_locais_id = $tbl_locais_id;
        $this->criado_em = $criado_em;
    }

    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getCodigoEsp() { return $this->codigo_esp; }
    public function getAtivo() { return $this->ativo; }
    public function getTblLocaisId() { return $this->tbl_locais_id; }
    public function getCriadoEm() { return $this->criado_em; }

    public function setNome($nome) { $this->nome = $nome; }
    public function setCodigoEsp($codigo_esp) { $this->codigo_esp = $codigo_esp; }
    public function setAtivo($ativo) { $this->ativo = $ativo; }
    public function setTblLocaisId($tbl_locais_id) { $this->tbl_locais_id = $tbl_locais_id; }
}
?>
