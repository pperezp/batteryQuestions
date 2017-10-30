<?php
require_once("../model/Data.php");

$pregunta       = $_REQUEST["pregunta"];
$tags           = $_REQUEST["tags"];
$infoExtra      = $_REQUEST["infoExtra"];
$cantResp       = $_REQUEST["cantRes"];
$indexCorrecta  = $_REQUEST["correcta"];

$preg = new Pregunta();
$preg->setValor($pregunta);
$preg->setTags($tags);

if($infoExtra){
    $ie = new InfoExtra();

    $nombre = $_FILES["fileInfoExtra"]["name"];
    $tipo   = $_FILES["fileInfoExtra"]["type"];
    $size   = $_FILES["fileInfoExtra"]["size"];
    $tmp    = $_FILES['fileInfoExtra']['tmp_name'];

    $binario = addslashes(fread(fopen($tmp, "rb"), filesize($tmp)));

    $ie->archivo    = $binario;
    $ie->nombre     = $nombre;
    $ie->peso       = $size;
    $ie->tipo       = $tipo;
}else{
    $ie = null;
}

$listRespuestas = array();

for($i =0; $i<$cantResp ; $i++){
    $resp = new Respuesta();
    
    $resp->setValor($_REQUEST["valor_$i"]);

    if($i == $indexCorrecta)
        $resp->setCorrecta("true");
    else
        $resp->setCorrecta("false");
    
    array_push($listRespuestas, $resp);
}

$d = new Data();

$d->crearPregunta($preg, $listRespuestas, $ie);

header("location: ../view/crearPreguntas.php");
?>