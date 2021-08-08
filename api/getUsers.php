<?php 
require 'commun_services.php';

try {
    $users = $db->getUsers();
    if($users){
        produceResult(clearDataArray($users));
    }else {
        produceError("Problème de Récupération des utilisateurs");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}



?>