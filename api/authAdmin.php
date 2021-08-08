<?php 
session_start();
require 'commun_services.php';



// Cas où la requête est mal formulée
if(!isset($_REQUEST['email']) || !isset($_REQUEST['password'])){
    ProduceErrorRequest();
    return;
}

try {
    $admin = new AdminEntity();
    $admin->setEmail($_REQUEST['email']);
    $admin->setPassword($_REQUEST['password']);
    
    $dataAuth = $db->authAdmin($admin);
    if($dataAuth){
        // Authentification réussie
        $_SESSION['ident']=$dataAuth;
        produceResult(clearData($dataAuth));
        
    }else {
        //Echec d'autentification
        produceError("Email ou password incorrecte. Merci de réessayer !");
    }



} catch (Exception $th) {
    produceError($th->getMessage());
}



?>