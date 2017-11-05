<!DOCTYPE html>
<html lang="es">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php require_once("../model/Bootstrap.php");?>
    </head>
    <body>
        <div class="container">
            <hr><h1>Crear pregunta</h1><hr>
            <form enctype="multipart/form-data" action="../controller/crearPregunta.php" method="POST">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="pregunta">Pregunta:</label>
                        <textarea class="form-control" name="pregunta"></textarea>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="tags">Tags:</label>
                        <textarea class="form-control" name="tags"></textarea>
                    </div>

                    <div class="form-group col-md-4">
                        <label for="cboTags">Listado de tags:</label>
                        <?php 
                        require_once("../model/Data.php");
                        $d = new Data();
                        $tags = $d->getTags();
                        $cantTags = sizeof($tags);
                        ?>
                        <select id="cboTags" name="cboTags" class="custom-select form-control">
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
                    <div class="col-md-6">
                        <label for="fileInfoExtra">Información extra:</label>

                        <!-- Image file with image preview -->
                        <script src="../js/scriptInputFile.js"></script>
                        <link type="text/css" rel="stylesheet" href="../css/estilo.css">
                        
                        <div class="input-group image-preview">
                            <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                            <span class="input-group-btn">
                                <!-- image-preview-clear button -->
                                <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                    <span class="glyphicon glyphicon-remove"></span> Limpiar
                                </button>
                                <!-- image-preview-input -->
                                <div class="btn btn-default image-preview-input">
                                    <span class="glyphicon glyphicon-folder-open"></span>
                                    <span class="image-preview-input-title">Examinar</span>
                                    <input type="file" accept="image/png, image/jpeg, image/gif" name="fileInfoExtra"/> <!-- rename it -->
                                </div>
                            </span>
                        </div>
                        <!-- Image file with image preview -->
                    </div>
                    <div class="form-group  col-md-6">
                        <label for="cantRes">Respuestas:</label>
                        <input placeholder="Cantidad de respuestas" class="form-control" type="number" id="cantRes" name="cantRes" onkeyup="generarRespuestas()">
                    </div>
                </div>
                
                <div class="row" id="respuestas"></div>
                
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Guardar pregunta" class="btn btn-success">
                    </div>
                </div>
            </form>

            <script>
                function generarRespuestas(){
                    var cantRes = document.getElementById("cantRes").value;
                    var divRespuestas = document.getElementById("respuestas");

                    cantRes = parseInt(cantRes);

                    divRespuestas.innerHTML = "";
                    for(var i = 0; i < cantRes ; i++){
                        divRespuestas.innerHTML += "<div class='col-md-3 form-group'><input type='radio' name='correcta' value='"+i+"'>¿Correcta?<textarea class='form-control' name='valor_"+i+"'></textarea></div>";
                    }
                }

                
            </script>

            <a href='index.php'>Volver</a>
        </div>
    </body>
</html>
