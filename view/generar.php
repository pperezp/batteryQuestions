<!DOCTYPE html>
<html lang="es">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>

        var i = 0;

        function eliminar(id){
            var element_id      = document.getElementById("id_"+id);
            var element_val     = document.getElementById("value_"+id);
            var element_btn     = document.getElementById("btn_"+id);
            
            element_id.outerHTML = "";
            element_val.outerHTML = "";
            element_btn.outerHTML = "";

            delete element_id;
            delete element_value;
            delete element_btn;

            i--;
            var cantTags = document.getElementById("cantTags");
            cantTags.value = i;
        }

        function addTag(e, value){
            $.ajax({
                url: "../controller/getTagId.php",
                data: {
                    tagName: value
                },
                success: function( tagId ) {
                    var men = document.getElementById("mensaje");

                    if(tagId != -1){
                        var generado = document.getElementById("generado");
                        
                        
                        if(!generado.innerHTML.includes(value)){
                            generado.innerHTML += "<input id='id_"+i+"' type='hidden' name='id_"+i+"' value='"+tagId+"'>";
                            generado.innerHTML += "<input id='value_"+i+"' type='text' value='"+value+"' readonly>";
                            generado.innerHTML += "<input id='btn_"+i+"' type='button' onclick='eliminar("+i+")' value='Eliminar'>";
                            generado.innerHTML += "<br>";
                            men.innerHTML = "";
                            i++;

                            var cantTags = document.getElementById("cantTags");
                            cantTags.value = i;
                        }else{
                            men.innerHTML = "El tag ya está en la lista";
                        }
                    }else{
                        men.innerHTML = "El tag no existe";
                    }
                }
            });
        }
        </script>
    </head>
    <body>
        <h1>Generar Preguntas</h1>

        <form id="formTags" action="../controller/generarPreguntas.php" method="post">
            <input name="cantidad" placeholder="Cantidad de preguntas:">
            <select  onclick="addTag(event, this.value)">
                <option value="">Seleccione un tag...</option>
                <?php
                require_once("../model/Data.php");

                $d = new Data();

                foreach($d->getTags() as $t){
                    echo "<option value='".$t->nombre."'>".$t->nombre."</option>";
                }
                ?>
            </select>
            <input type="hidden" value="0" name="cantTags" id="cantTags">
            <br>
            <div id="generado"></div>
            <br>
            <input type="submit" value="Generar">
        </form>

        <div id="mensaje"></div>

        <a href="index.php">Volver</a>
    </body>
</html>