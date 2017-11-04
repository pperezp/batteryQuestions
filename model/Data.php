<?php
require_once("Conexion.php");
require_once("Pregunta.php");
require_once("Respuesta.php");
require_once("InfoExtra.php");
require_once("Tag.php");

class Data{
    private $c;

    public function __construct(){
        $this->c = new Conexion("batteryQuestions");
    }

    public function crearPregunta($preg, $listResp, $ie){
        /*---------------------INSERT TABLA PREGUNTA---------------------*/
        $this->c->conectar();

        $this->c->ejecutar("INSERT INTO pregunta 
        VALUES(NULL, '".$preg->valor."')");

        $this->c->desconectar();
        /*---------------------INSERT TABLA PREGUNTA---------------------*/


        /*---------------------INSERT TABLA RESPUESTA---------------------*/
        $idPreg = $this->getMaxIdPregunta();

        $this->c->conectar();
        foreach($listResp as $r){
            $this->c->ejecutar("INSERT INTO respuesta 
            VALUES(NULL, '".$r->valor."','$idPreg',".$r->correcta.")");
        }
        $this->c->desconectar();
        /*---------------------INSERT TABLA RESPUESTA---------------------*/

        /*---------------------INSERT TABLA INFOEXTRA---------------------*/
        if($ie != null){
            $ie->pregunta = $idPreg;
            $this->crearInfoExtra($ie);
        }
        /*---------------------INSERT TABLA INFOEXTRA---------------------*/


        /*------------------------------TAGS------------------------------*/
        $tags = explode(",",$preg->tags);
        
        /*Recorro todos los nameTag*/
        foreach($tags as $tagName){
            // Veo si esta en la bd, si es asi, entrego el objeto
            $tagName = strlower(trim($tagName));
            $tag = $this->getTag($tagName);

            // si no se encuentra en la BD
            if($tag == null){
                // Lo creo en la bd, y devuelvo el objeto creado, con el id incluido
                $tag = $this->crearTag($tagName);
            }

            // creo el registro de la tabla intermedia
            $this->crearPreguntaTag($idPreg, $tag->id);
        }
        /*------------------------------TAGS------------------------------*/
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

    public function getMaxIdTag(){
        $this->c->conectar();
        $rs = $this->c->ejecutar("SELECT MAX(id) FROM tag");

        $id = -1;

        if($obj = $rs->fetch_array()){
            $id = $obj[0];
        }

        $this->c->desconectar();

        return $id;
    }

    public function getPreguntas(){
        $preguntas = array();

        $this->c->conectar();
        $rs = $this->c->ejecutar("SELECT * FROM pregunta");

        while($obj = $rs->fetch_object()){
            array_push($preguntas, $obj);
        }

        $this->c->desconectar();

        return $preguntas;
    }

    public function getPreguntaBy($id){
        $this->c->conectar();
        $rs = $this->c->ejecutar("SELECT * FROM pregunta WHERE id = $id");

        $p = null;

        if($obj = $rs->fetch_object()){
            $p = $obj;
        }

        $this->c->desconectar();

        return $p;
    }

    public function getRespuestasBy($idPregunta){
        $respuestas = array();

        $this->c->conectar();
        $rs = $this->c->ejecutar("SELECT * FROM respuesta WHERE pregunta = $idPregunta");

        while($obj = $rs->fetch_object()){
            array_push($respuestas, $obj);
        }

        $this->c->desconectar();

        return $respuestas;
    }

    public function getInfoExtraBy($idPregunta){
        $this->c->conectar();
        $rs = $this->c->ejecutar("SELECT * FROM infoExtra WHERE pregunta = $idPregunta");

        $ie = null;
        if($obj = $rs->fetch_object()){
            $ie = $obj;
        }

        $this->c->desconectar();

        return $ie;
    }

    public function crearInfoExtra($ie){
        $this->c->conectar();

        $this->c->ejecutar("INSERT INTO infoExtra 
        VALUES(NULL, 
        '".$ie->archivo."',
        '".$ie->nombre."',
        '".$ie->peso."',
        '".$ie->tipo."',
        '".$ie->pregunta."');");

        $this->c->desconectar();
    }

    public function crearTag($tagName){
        $this->c->conectar();

        $this->c->ejecutar("INSERT INTO tag VALUES(NULL, '$tagName');");

        $this->c->desconectar();

        $idTag = $this->getMaxIdTag();

        $t = new Tag();

        $t->id = $idTag;
        $t->nombre = $tagName;

        return $t;
    }

    public function crearPreguntaTag($idPregunta, $idTag){
        $this->c->conectar();

        $this->c->ejecutar("INSERT INTO preguntaTag VALUES(NULL, $idPregunta, $idTag);");

        $this->c->desconectar();
    }

    public function getTag($tagName){
        $this->c->conectar();

        $tagName = strtolower($tagName);

        $rs = $this->c->ejecutar("SELECT * FROM tag WHERE nombre = '$tagName'");

        $t = null;
        if($obj = $rs->fetch_array()){
            $t = new Tag();

            $t->id = $obj[0];
            $t->nombre = $obj[1];
        }

        $this->c->desconectar();

        return $t;
    }

    public function getTagsBy($idPregunta){
        $tags = array();

        $this->c->conectar();
        $rs = $this->c->ejecutar(
           "SELECT
                t.id,
                t.nombre
            FROM
                tag t
                INNER JOIN preguntaTag pt ON t.id = pt.tag
                INNER JOIN pregunta p ON p.id = pt.pregunta
            WHERE
                p.id = $idPregunta;");

        while($obj = $rs->fetch_object()){
            array_push($tags, $obj);
        }

        $this->c->desconectar();

        return $tags;
    }

    public function getTags(){
        $tags = array();

        $this->c->conectar();
        $rs = $this->c->ejecutar("SELECT * FROM tag ORDER BY nombre");

        while($obj = $rs->fetch_object()){
            array_push($tags, $obj);
        }

        $this->c->desconectar();

        return $tags;
    }
}
?>
