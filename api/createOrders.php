<?php 
require 'commun_services.php';

if(!isset($_REQUEST['idUser']) || !isset($_REQUEST['idProduct']) 
|| !isset($_REQUEST['quantity']) || !isset($_REQUEST['price'])){
    produceErrorRequest();
    return;
}



if(empty($_REQUEST['idUser']) || empty($_REQUEST['idProduct']) 
|| empty($_REQUEST['quantity']) || empty($_REQUEST['price'])){
    produceErrorRequest();
    return;
}

 try {
    $order = new OrdersEntity();
    $order->setIdUser($_REQUEST['idUser']);
    $order->setIdProduct($_REQUEST['idProduct']);
    $order->setQuantity($_REQUEST['quantity']);
    $order->setPrice($_REQUEST['price']);

    $result = $db->createOrders($order);

    if($result){
        setLastInsertId($result);
        produceResult("Commande créée avec succès");
    }else {
        produceError("Erreur lors de la création de la commande. Merci de réessayer !");
    }

 } catch (Exception $th) {
     produceError($th->getMessage());
 }


?>