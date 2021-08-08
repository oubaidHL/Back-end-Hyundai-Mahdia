<?php 
require 'commun_services.php'; 

if(!isset($_REQUEST["idProduct"])){
    produceErrorRequest();
    return;
}
if(empty($_REQUEST["idProduct"])  ){
    produceErrorRequest();
    return;
}

$product = new ProductEntity();
$product->setIdProduct($_REQUEST["idProduct"]);
try {
    $products = $db->getProductById($product);
    if($products){
        produceResult(clearDataArray($products));
        
    }else {
        produceError("Problème de Récupération des products");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}



?>