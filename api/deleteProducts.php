<?php
require 'commun_services.php';

if(!isset($_REQUEST["idProduct"]) || !is_numeric($_REQUEST["idProduct"])){
    produceErrorRequest();
    return;
}

$product = new ProductEntity();
$product->setIdProduct($_REQUEST["idProduct"]);

try {
    $data = $db->deleteProduct($product);

    if($data){
        produceResult('Suppression réussie ;');
    }else {
        produceError("Echec de la suppression. Merci de réessayer !");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}