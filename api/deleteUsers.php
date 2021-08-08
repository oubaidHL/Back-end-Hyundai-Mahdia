<?php
require 'commun_services.php';

if(!isset($_REQUEST["idUser"]) || !is_numeric($_REQUEST["idUser"])){
    produceErrorRequest();
    return;
}

$user = new UserEntity();
$user->setIdUser($_REQUEST["idUser"]);

try {
    $data = $db->deleteUsers($user);

    if($data){
        produceResult('Suppression réussie ;');
    }else {
        produceError("Echec de la suppression. Merci de réessayer !");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}