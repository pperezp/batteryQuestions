<!DOCTYPE html>
<html lang="es">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <form enctype="multipart/form-data" action="procesar_mysql.php" method="POST">
            Enviar este fichero: <input name="info" type="file" />
            <input type="submit" value="Enviar fichero" />
        </form>

        <a href='ver.php'>Ver archivos</a>
    </body>
</html>