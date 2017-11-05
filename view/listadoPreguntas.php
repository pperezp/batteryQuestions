<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <?php require_once("../model/Bootstrap.php");?>
    </head>
    <body>
        <div class="container">
            <hr>
            <h1>Todas las preguntas</h1>
            <hr>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pregunta</th>
                        <th>Tags</th>
                        <th>Ver</th>
                    </tr>    
                </thead>
                <tbody >
                <?php
                require_once("../model/Data.php");

                $d = new Data();

                foreach($d->getPreguntas() as $p){?>
                    <tr>
                        <td><?php echo $p->id; ?></td>
                        <td><?php echo $p->valor; ?></td>
                        <td>
                        <?php
                        foreach($d->getTagsBy($p->id) as $t){
                            echo "[".$t->nombre."] ";
                        }
                        ?>
                        </td>
                        <td><a class="btn btn-success" href='verPregunta.php?id=<?php echo $p->id; ?>'>Ver</a></td>
                    </tr>
            <?php } ?>
                </tbody>
            </table>

            <a href='index.php' class="btn btn-primary">Volver</a>
        </div>
    </body>
</html>
