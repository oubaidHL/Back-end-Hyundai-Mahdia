<?php
require 'commun_services.php';

if(!isset($_REQUEST["idOrder"]) || !is_numeric($_REQUEST["idOrder"])){
    produceErrorRequest();
    return;
}

$order = new OrdersEntity();
$order->setIdOrder($_REQUEST["idOrder"]);

try {
    $data = $db->deleteOrders($order);

    if($data){
        produceResult('Suppression réussie ;');
    }else {
        produceError("Echec de la suppression. Merci de réessayer !");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}