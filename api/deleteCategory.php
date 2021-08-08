<?php
require 'commun_services.php';

if(!isset($_REQUEST["idCategory"]) || !is_numeric($_REQUEST["idCategory"])){
    produceErrorRequest();
    return;
}

$category = new CategoryEntity();
$category->setIdCategory($_REQUEST["idCategory"]);

try {
    $data = $db->deleteCategory($category);

    if($data){
        produceResult('Suppression réussie ;');
    }else {
        produceError("Echec de la suppression. Merci de réessayer !");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}