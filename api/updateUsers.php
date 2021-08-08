<?php
require 'commun_services.php';

if(!isset($_REQUEST["id"]) || !isset($_REQUEST["password"]) || !isset($_REQUEST["pseudo"]) || !isset($_REQUEST["firstname"]) || !isset($_REQUEST["lastname"])
|| !isset($_REQUEST["image"]) || !isset($_REQUEST["adresse_facturation"]) || !isset($_REQUEST["adresse_livraison"])
|| !isset($_REQUEST["tel"])|| !isset($_REQUEST["email"])|| !isset($_REQUEST["dateBirth"])){
    produceErrorRequest();
    return;
}
if(empty($_REQUEST["id"]) || empty($_REQUEST["password"]) || empty($_REQUEST["pseudo"]) || empty($_REQUEST["firstname"]) || empty($_REQUEST["lastname"])
|| empty($_REQUEST["image"]) || empty($_REQUEST["adresse_facturation"]) || empty($_REQUEST["adresse_livraison"])
|| empty($_REQUEST["tel"])|| empty($_REQUEST["email"])|| empty($_REQUEST["dateBirth"])){
    produceErrorRequest();
    return;
}

$user = new UserEntity();
$user->setIdUser($_REQUEST["id"]);
$user->setPassword($_REQUEST["password"]);
$user->setPseudo(($_REQUEST["pseudo"]));
$user->setFirstname($_REQUEST["firstname"]);
$user->setLastname($_REQUEST["lastname"]);
$user->setEmail($_REQUEST["email"]);
$user->setAdresseLivraison($_REQUEST["adresseLivraison"]);
$user->setAdresseFacturation($_REQUEST["adresseFacturation"]);
$user->setDateBirth($_REQUEST["dateBirth"]);
$user->setImage($_REQUEST["image"]);
$user->setPassword($_REQUEST["password"]);


try {
    $data = $db->updateUsers($user);

    if($data){
        produceResult('modification réussie ;');
    }else {
        produceError("Echec de la mise à jour. Merci de réessayer !");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}

?>