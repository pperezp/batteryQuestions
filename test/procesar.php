<?php

$dir_subida = "../archivos/";

$nombre = $_FILES["info"]["name"];
$tipo   = $_FILES["info"]["type"];
$size   = $_FILES["info"]["size"];
$tmp    = $_FILES['info']['tmp_name'];

$fichero_subido = $dir_subida .rand()."_".$nombre;

echo $fichero_subido."<br>";

if(move_uploaded_file($tmp , $fichero_subido)){
    echo "Se subió con éxito";
}else{
    echo "Error";
}

echo "<br>";
echo 'Más información de depuración:';
print_r($_FILES);
echo "<br>";

echo "<a href='test.php'>Volver</a>";
?>