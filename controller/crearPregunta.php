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
    // Existe info extra
}else{
    // No existe info extra
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

$d->crearPregunta($preg, $listRespuestas);

header("location: ../view/crearPreguntas.php");
?>