<?php
require_once("../model/Conexion.php");
$c = new Conexion("batteryQuestions");

$c->conectar();

$rs = $c->ejecutar("SELECT * FROM test;");

while($obj = $rs->fetch_array()){
    echo "PESO = ".$obj[3]." TIPO = ".$obj[4]." NOMBRE = ".$obj[2];
    echo " <a href='descargar.php?id=".$obj[0]."'>Descargar</a><br>";
}

$c->desconectar();
?>
