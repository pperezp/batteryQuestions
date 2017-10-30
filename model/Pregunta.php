<?php
class Pregunta{
    private $id;
    private $valor;
    private $tags;

    public function getId(){
        return $this->id;
    }

    public function getValor(){
        return $this->valor;
    }

    public function getTags(){
        return $this->tags;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }

    public function setTags($tags){
        $this->tags = $tags;
    }
}
?>