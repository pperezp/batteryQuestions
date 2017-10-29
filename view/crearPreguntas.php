<!DOCTYPE html>
<html lang="es">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>Crear pregunta</h1>
        <form action="../controller/crearPregunta.php" method="POST">
            Pregunta:
            <textarea name="pregunta"></textarea>
            <br>
            Tags: 
            <textarea name="tags"></textarea>
            <br>
            <input type="checkbox" id="infoExtra" name="infoExtra" onclick="generarInfo()">Información extra
            <div id="genInfo">

            </div>
            <br>
            Respuestas: <input type="number" id="cantRes" name="cantRes" onkeyup="generarRespuestas()">
            <br>
            <div id="respuestas"></div>
            <br>
            <input type="submit" value="Guardar pregunta">
        </form>

        <script>
            function generarRespuestas(){
                var cantRes = document.getElementById("cantRes").value;
                var divRespuestas = document.getElementById("respuestas");

                cantRes = parseInt(cantRes);

                divRespuestas.innerHTML = "";
                for(var i = 0; i < cantRes ; i++){
                    divRespuestas.innerHTML += "<input type='radio' name='correcta' value='"+i+"'>";
                    divRespuestas.innerHTML += "<textarea name='valor_"+i+"'></textarea>";
                    divRespuestas.innerHTML += "<br>";
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
    </body>
</html>