<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h1>Todas las preguntas</h1>
        <table border=''>
            <tr>
                <th>ID</th>
                <th>Pregunta</th>
                <th>Tags</th>
                <th>Ver</th>
            </tr>    

            <?php
            require_once("../model/Data.php");

            $d = new Data();

            foreach($d->getPreguntas() as $p){?>
                <tr>
                    <td><?php echo $p->id; ?></td>
                    <td><?php echo $p->valor; ?></td>
                    <td><?php echo $p->tags; ?></td>
                    <td><a href='verPregunta.php?id=<?php echo $p->id; ?>'>Ver</a></td>
                </tr>
        <?php } ?>
        </table>

        <a href='index.php'>Volver</a>
    </body>
</html>
