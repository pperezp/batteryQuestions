<!DOCTYPE html>
<html lang="es">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <?php
        require_once("../model/Data.php");
        $idPregunta = $_REQUEST["id"];

        $d = new Data();

        $preg = $d->getPreguntaBy($idPregunta);
        $resp = $d->getRespuestasBy($idPregunta);
        $ie = $d->getInfoExtraBy($idPregunta);

        echo $preg->valor;
        echo "<br>";
        if($ie != null){
            echo "<img src='data:image/png;base64,".base64_encode($ie->archivo)."'/>";
        }
        echo "<br>";

        $i = 97; // a en el ascii
        foreach($resp as $r){
            echo chr($i).") ";
            if($r->correcta){
                echo "<b>".$r->valor."</b>";
            }else{
                echo $r->valor;
            }
            echo "<br>";
            $i++;
        }
        ?>
        <a href='listadoPreguntas.php'>Volver</a>
    </body>
</html>