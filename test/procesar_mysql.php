<?php
$nombre = $_FILES["info"]["name"];
$tipo   = $_FILES["info"]["type"];
$size   = $_FILES["info"]["size"];
$tmp    = $_FILES['info']['tmp_name'];

$binario = addslashes(fread(fopen($tmp, "rb"), filesize($tmp)));

require_once("../model/Conexion.php");
$c = new Conexion("batteryQuestions");

$c->conectar();
$c->ejecutar("INSERT INTO test VALUES(NULL, '$binario','$nombre',$size,'$tipo');");
$c->desconectar();

header("location: test.php");
?>