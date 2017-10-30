<?php
require_once("Conexion.php");
require_once("Pregunta.php");
require_once("Respuesta.php");
require_once("InfoExtra.php");

class Data{
    private $c;

    public function __construct(){
        $this->c = new Conexion("batteryQuestions");
    }

    public function crearPregunta($preg, $listResp, $ie){
        $this->c->conectar();
        
        $this->c->ejecutar("INSERT INTO pregunta VALUES(NULL, '".$preg->getValor()."', '".$preg->getTags()."')");
        
        $idPreg = $this->getMaxIdPregunta();

        $this->c->conectar();
        foreach($listResp as $r){
            $this->c->ejecutar("INSERT INTO respuesta VALUES(NULL, '".$r->getValor()."','$idPreg',".$r->isCorrecta().")");
        }
        
        $this->c->desconectar();

        if($ie != null){
            $ie->pregunta = $idPreg;
            $this->crearInfoExtra($ie);
        }
    }

    public function getMaxIdPregunta(){
        $this->c->conectar();
        $rs = $this->c->ejecutar("SELECT MAX(id) FROM pregunta");

        $id = -1;

        if($obj = $rs->fetch_array()){
            $id = $obj[0];
        }

        $this->c->desconectar();

        return $id;
    }

    public function crearInfoExtra($ie){
        $this->c->conectar();

        $this->c->ejecutar("INSERT INTO infoExtra VALUES(NULL, '".$ie->archivo."','".$ie->nombre."','".$ie->peso."','".$ie->tipo."','".$ie->pregunta."');");

        $this->c->desconectar();
    }
}
?>