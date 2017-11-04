<!DOCTYPE html>
<html lang="es">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Imports de Bootstrap 4 -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
            crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
            crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
            crossorigin="anonymous"></script>
        <!-- Imports de Bootstrap 4 -->
    </head>
    <body>
        <div class="container">
            <hr><h1>Crear pregunta</h1><hr>
            <form enctype="multipart/form-data" action="../controller/crearPregunta.php" method="POST">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="pregunta">Pregunta:</label>
                        <textarea class="form-control" name="pregunta"></textarea>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="tags">Tags:</label>
                        <textarea class="form-control" name="tags"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-1">
                        <button class="btn btn-primary" type="button" data-toggle="collapse" 
                            data-target="#divTags" aria-expanded="false" 
                            aria-controls="divTags">
                            Ver tags
                        </button>
                    </div>

                    <?php 
                    require_once("../model/Data.php");
                    $d = new Data();
                    $tags = $d->getTags();
                    $cantTags = sizeof($tags);
                    ?>
                    <div class="collapse form-group col-md-11" id="divTags" >
                        <label for="cboTags">Listado de tags:</label>
                        <select id="cboTags" class="custom-select">
                            <?php
                            $letActual = "";
                            $nuevaLetra = true;

                            /*Cargando el combo con los tags*/
                            foreach($tags as $t){
                                $nombre = $t->nombre;
                                $letInicial = substr($nombre, 0, 1);

                                if($nuevaLetra){
                                    $letActual = $letInicial;
                                    echo "<optgroup label='".strtoupper($letActual)."'>";
                                    $nuevaLetra  = false;
                                }else if($letActual != $letInicial){
                                    $letActual = $letInicial;
                                    echo "</optgroup>";
                                    echo "<optgroup label='".strtoupper($letActual)."'>";
                                }

                                echo "<option>".$nombre."</option>";
                            }
                            /*Cargando el combo con los tags*/
                            ?>
                            </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-2">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" id="infoExtra" name="infoExtra" onclick="generarInfo()">
                            Información extra:
                        </label>
                    </div>
                    <div id="genInfo" class="col-md-10"></div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <label for="cantRes">Respuestas:</label>
                        <input class="form-control" type="number" id="cantRes" name="cantRes" onkeyup="generarRespuestas()">
                    </div>
                </div>

                
                <div class="row" id="respuestas">
                </div>
                
                <input type="submit" value="Guardar pregunta" class="btn btn-s">
            </form>

            <script>
                function generarRespuestas(){
                    var cantRes = document.getElementById("cantRes").value;
                    var divRespuestas = document.getElementById("respuestas");

                    cantRes = parseInt(cantRes);

                    divRespuestas.innerHTML = "";
                    for(var i = 0; i < cantRes ; i++){
                        divRespuestas.innerHTML += "<div class='col-md-3'>";
                            divRespuestas.innerHTML += "<input type='radio' name='correcta' value='"+i+"'>";
                            divRespuestas.innerHTML += "<textarea class='form-control' name='valor_"+i+"'></textarea>";
                        divRespuestas.innerHTML += "</div>";
                    }
                }

                function generarInfo(){
                    var infoExtra = document.getElementById("infoExtra");

                    if(infoExtra.checked){
                        genInfo.innerHTML = "<input type='file' name='fileInfoExtra'>";
                    }else{
                        genInfo.innerHTML = "";
                    }
                }
            </script>

           

            <a href='index.php'>Volver</a>
        </div>
    </body>
</html>
