<?php
require 'commun_services.php';

if(!isset($_REQUEST["idProduct"]) || !isset($_REQUEST["name"]) || !isset($_REQUEST["description"]) || !isset($_REQUEST["price"])
|| !isset($_REQUEST["stock"]) || !isset($_REQUEST["idCategory"]) || !isset($_REQUEST["image"])){
    produceErrorRequest();
    return;
}
if(empty($_REQUEST["idProduct"]) || empty($_REQUEST["name"]) || empty($_REQUEST["description"]) || empty($_REQUEST["price"])
|| empty($_REQUEST["stock"]) || empty($_REQUEST["idCategory"]) || empty($_REQUEST["image"])){
    produceErrorRequest();
    return;
}

$product = new ProductEntity();
$product->setIdProduct($_REQUEST["idProduct"]);
$product->setName($_REQUEST['name']);
$product->setDescription($_REQUEST['description']);
$product->setPrice($_REQUEST['price']);
$product->setStock($_REQUEST['stock']);
$product->setCategory($_REQUEST['idCategory']);
$product->setImage($_REQUEST['image']);

try {
    $data = $db->updateProduct($product);

    if($data){
        produceResult('modification réussie ;');
    }else {
        produceError("Echec de la mise à jour. Merci de réessayer !");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}



?>