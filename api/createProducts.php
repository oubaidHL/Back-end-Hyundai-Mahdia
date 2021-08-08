<?php 
require 'commun_services.php';

if(!isset($_REQUEST['name']) || !isset($_REQUEST['description']) || !isset($_REQUEST['price']) ||
!isset($_REQUEST['stock']) || !isset($_REQUEST['idCategory']) || !isset($_REQUEST['image'])){
    produceErrorRequest();
    return;
}

if(empty($_REQUEST['name']) || empty($_REQUEST['description']) || empty($_REQUEST['price']) ||
empty($_REQUEST['stock']) || empty($_REQUEST['idCategory']) || empty($_REQUEST['image'])){
    produceErrorRequest();
    return;
}

$product = new ProductEntity();
$product->setName($_REQUEST['name']);
$product->setDescription($_REQUEST['description']);
$product->setPrice($_REQUEST['price']);
$product->setStock($_REQUEST['stock']);
$product->setCategory($_REQUEST['idCategory']);
$product->setImage($_REQUEST['image']);


try {
   $data = $db->createProduct($product);
   if($data){
        setLastInsertId($data);
       produceResult("Produit enrégistré avec succès !");
   }else {
       produceError("Problème rencontré lors de l'enregistrement");
   }

} catch (Exception $th) {
    produceError($th->getMessage());
}



?>