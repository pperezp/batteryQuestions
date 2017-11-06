<?php
require_once("../model/Data.php");
$cantTags = $_REQUEST["cantTags"];

$d = new Data();

$ids = array();
for($i=0; $i<$cantTags; $i++){
    $idTag = $_REQUEST["id_$i"];
    array_push($ids, $idTag);
}

$preguntas = $d->getPreguntasByTags($ids);

foreach($preguntas as $p){
    echo $p->id." - ".$p->valor."<br>";

    $infoExtra = $d->getInfoExtraBy($p->id);

    if($infoExtra != null){
        echo "<img src='data:image/png;base64,".base64_encode($infoExtra->archivo)."'/><br>";
    }

    $respuestas = $d->getRespuestasBy($p->id);

    $cont = 1;
    foreach($respuestas as $r){
        echo "$cont) ".$r->valor."<br>";
    }
    echo "<br>";
}

echo "<a href='../view/generar.php'>Volver</a>";
?>