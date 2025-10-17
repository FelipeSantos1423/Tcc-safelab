<?php
class Leitura {
    private $id;
    private $tbl_dispositivos_id;
    private $temperatura;
    private $umidade;
    private $luz;
    private $ruido;
    private $data_regitro;

    public function __construct($id = null, $tbl_dispositivos_id = null, $temperatura = null, $umidade = null, $luz = null, $ruido = null, $data_regitro = null) {
        $this->id = $id;
        $this->tbl_dispositivos_id = $tbl_dispositivos_id;
        $this->temperatura = $temperatura;
        $this->umidade = $umidade;
        $this->luz = $luz;
        $this->ruido = $ruido;
        $this->data_regitro = $data_regitro;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getDispositivoId() {
        return $this->tbl_dispositivos_id;
    }

    public function getTemperatura() {
        return $this->temperatura;
    }

    public function getUmidade() {
        return $this->umidade;
    }

    public function getLuz() {
        return $this->luz;
    }

    public function getRuido() {
        return $this->ruido;
    }

    public function getDataRegistro() {
        return $this->data_regitro;
    }

    // Setters
    public function setDispositivoId($tbl_dispositivos_id) {
        $this->tbl_dispositivos_id = $tbl_dispositivos_id;
    }

    public function setTemperatura($temperatura) {
        $this->temperatura = $temperatura;
    }

    public function setUmidade($umidade) {
        $this->umidade = $umidade;
    }

    public function setLuz($luz) {
        $this->luz = $luz;
    }

    public function setRuido($ruido) {
        $this->ruido = $ruido;
    }

    public function setDataRegistro($data_regitro) {
        $this->data_regitro = $data_regitro;
    }
}
?>
