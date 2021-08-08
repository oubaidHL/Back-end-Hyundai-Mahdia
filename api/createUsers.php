<?php 
require 'commun_services.php'; 

if(!isset($_REQUEST["sexe"]) || !isset($_REQUEST["pseudo"]) || !isset($_REQUEST["firstname"]) || !isset($_REQUEST["lastname"])
|| !isset($_REQUEST["password"])|| !isset($_REQUEST["email"]) || !isset($_REQUEST["dateBirth"])){
    produceErrorRequest();
    return;
}
if(empty($_REQUEST["sexe"]) || empty($_REQUEST["pseudo"]) || empty($_REQUEST["email"]) || empty($_REQUEST["password"])
 || empty($_REQUEST["firstname"]) || empty($_REQUEST["lastname"])  ){
    produceErrorRequest();
    return;
}

$user = new UserEntity();
$user->setSexe($_REQUEST["sexe"]);
$user->setPseudo(($_REQUEST["pseudo"]));
$user->setFirstname($_REQUEST["firstname"]);
$user->setLastname($_REQUEST["lastname"]);
$user->setEmail($_REQUEST["email"]);
$user->setPassword($_REQUEST["password"]);
$user->setDateBirth($_REQUEST["dateBirth"]);

try {
    $data = $db->createUser($user);

    if($data){
        setLastInsertId($data);
        produceResult("Compte utilisateur créé avec succès");
    }else{
        produceError("L'utilisateur est déja exist !!");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}




?>