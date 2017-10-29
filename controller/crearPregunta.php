<?php
$pregunta = $_REQUEST["pregunta"];
$infoExtra = $_REQUEST["infoExtra"];

echo $pregunta;
echo "<br>";
if($infoExtra){
    echo "Existe información extra<br>";
}else{
    echo "No existe información extra<br>";
}

$cantResp = $_REQUEST["cantRes"];
$indexCorrecta = $_REQUEST["correcta"];

for($i =0; $i<$cantResp ; $i++){
    $valor_resp = $_REQUEST["valor_$i"];
    echo $valor_resp." ";

    if($i == $indexCorrecta){
        echo " [Respuesta correcta]<br>";
    }else{
        echo " [Respuesta incorrecta]<br>";
    }
}

?>