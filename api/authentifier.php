<?php 
session_start();
require 'commun_services.php';

// Cas où l'utilisateur est déjà connecté
if(isset($_SESSION['ident'])){
    produceError("utilisateur déjà connecté");
    return;
}

// Cas où la requête est mal formulée
if(!isset($_REQUEST['email']) || !isset($_REQUEST['password'])){
    ProduceErrorRequest();
    return;
}

try {
    $user = new UserEntity();
    $user->setEmail($_REQUEST['email']);
    $user->setPassword($_REQUEST['password']);
    
    $dataAuth = $db->authentifier($user);

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