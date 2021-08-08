<?php 
require 'commun_services.php';


if(!isset($_REQUEST['name']) || empty($_REQUEST['name'])){
    produceErrorRequest();
    return;
}

try {
    $category = new CategoryEntity();
    $category->setName($_REQUEST['name']);
    if(isset($_REQUEST['icon']) || !empty($_REQUEST['icon'])){
        $category->setIcon($_REQUEST['icon']);
    }
    

    $result = $db->createCategory($category);

    if($result){
        setLastInsertId($result);
        produceResult("Categorie créée avec succès");
    }else{
        produceError("Echec de création de la categorie");
    }

} catch (Exception $th) {
    produceError($th->getMessage());
}




?>