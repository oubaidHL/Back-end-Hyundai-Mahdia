<?php 
require 'commun_services.php';

if(!isset($_REQUEST['idOrder']) || !isset($_REQUEST['status'])){
    produceErrorRequest();
    return;
}

if(empty($_REQUEST['idOrder']) || empty($_REQUEST['status'])){
    produceErrorRequest();
    return;
}

$order = new OrdersEntity();
$order->setIdOrder($_REQUEST['idOrder']);
$order->setStatus($_REQUEST['status']);


try {
    $data = $db->updateOrders($order);

    if($data){
        produceResult("Mise à jour réussie !");
    }else {
        produceError("Echec de la mise à jour. Merci de réessayer !");
    }

} catch (Exception $th) {
    produceError($th->getMessage());
}




?>