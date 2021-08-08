<?php 
require 'commun_services.php'; 

if(!isset($_REQUEST["email"])){
    produceErrorRequest();
    return;
}
if(empty($_REQUEST["email"])  ){
    produceErrorRequest();
    return;
}
$user= new UserEntity();

try {
    $user = $db->getUserById($_REQUEST["email"]);
    if($user){
        produceResult(clearDataArray($user));
        
    }else {
        produceError("Problème de Récupération d'utilisateur");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}



?>