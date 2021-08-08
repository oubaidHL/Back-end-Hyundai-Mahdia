<?php 
require "commun_services.php";

//var_dump($_FILES);

if(isset($_REQUEST["name"]) && !empty($_REQUEST["name"])){
    $filename = $_REQUEST["name"];
    $dirImage = realpath("..")."/images/products/".$filename;
    if(file_exists($dirImage)){
        unlink($dirImage);
        produceResult("Suppression de l'image réussie !");
    }else{
        produceError("L'image n'xiste pas sur le serveur");
    }
    
}else{
    produceErrorRequest();
}