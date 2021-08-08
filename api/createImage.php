<?php 
require "commun_services.php";

//var_dump($_FILES);

if(isset($_FILES) && is_array($_FILES)){
    if(isset($_FILES['image']["name"]) && !empty($_FILES['image']["name"])){
        $filename = $_FILES['image']["name"];
        $dirImage = realpath("..")."/images/products/".$filename;
        $save = move_uploaded_file($_FILES['image']["tmp_name"],$dirImage);

        if($save){
            produceResult("Image stocké sur le serveur avec succès !");
        }else{
            produceError("Erreur de stockage de l'image");
        }
    }else{
        produceErrorRequest();
    }
}else{
    produceErrorRequest();
}