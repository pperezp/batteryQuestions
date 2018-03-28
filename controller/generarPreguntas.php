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

    $ascii = 97; // el ascii de la letra 'a'
    foreach($respuestas as $r){
        $letra = chr($ascii);
        echo "$letra) ".$r->valor."<br>";
        $ascii++;
    }
    echo "<br>";
}

echo "<a href='../view/generar.php'>Volver</a>";
?>