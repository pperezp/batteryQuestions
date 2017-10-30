<?php
require_once("../model/Conexion.php");
$c = new Conexion("batteryQuestions");

$c->conectar();

$id = $_REQUEST["id"];

$rs = $c->ejecutar("SELECT * FROM test WHERE id = $id;");

if($obj = $rs->fetch_array()){
    $archivo = $obj[1];
    $nombre = $obj[2];
    $peso = $obj[3];
    $tipo = $obj[4];    
    header("Content-type: $tipo");
    header("Content-length: $peso"); 
    header("Content-Disposition: inline; filename=$nombre"); 

    echo $archivo;
}
$c->desconectar();

?>