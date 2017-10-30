<?php
class Respuesta{
    private $id;
    private $valor;
    private $pregunta;
    private $correcta;

    public function getId(){
        return $this->id;
    }

    public function getValor(){
        return $this->valor;
    }

    public function getPregunta(){
        return $this->pregunta;
    }

    public function isCorrecta(){
        return $this->correcta;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }

    public function setPregunta($pregunta){
        $this->pregunta = $pregunta;
    }

    public function setCorrecta($correcta){
        $this->correcta = $correcta;
    }
}
?>