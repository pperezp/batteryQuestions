<?php
class Pregunta{
    private $id;
    private $valor;
    private $categoria;

    public function getId(){
        return $this->id;
    }

    public function getValor(){
        return $this->valor;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }
}
?>