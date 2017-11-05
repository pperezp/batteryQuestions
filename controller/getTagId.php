<?php
require_once("../model/Data.php");
$tagName = $_REQUEST["tagName"];

$d = new Data();
$tag = $d->getTag($tagName);

if($tag != null){
    echo $tag->id;
}else{
    echo -1;
}
?>