<?php 
require 'commun_services.php'; 

if(!isset($_REQUEST["model"]) || !isset($_REQUEST["firstname"]) || !isset($_REQUEST["lastname"]) || !isset($_REQUEST["sexe"]) || !isset($_REQUEST["adresse"])
|| !isset($_REQUEST["cp"]) || !isset($_REQUEST["ville"]) || !isset($_REQUEST["tlfn"]) || !isset($_REQUEST["email"]) || !isset($_REQUEST["message"])){
    produceErrorRequest();
    return;
}

if(empty($_REQUEST["model"]) || empty($_REQUEST["firstname"]) || empty($_REQUEST["lastname"]) || empty($_REQUEST["sexe"]) || empty($_REQUEST["adresse"])
|| empty($_REQUEST["cp"]) || empty($_REQUEST["ville"]) || empty($_REQUEST["tlfn"]) || empty($_REQUEST["email"]) || empty($_REQUEST["message"])){
    produceErrorRequest();
    return;
}


$test = new TestDriveEntity();
$test->setSexe($_REQUEST["sexe"]);
$test->setModel(($_REQUEST["model"]));
$test->setFirstname($_REQUEST["firstname"]);
$test->setLastname($_REQUEST["lastname"]);
$test->setEmail($_REQUEST["email"]);
$test->setAdresse($_REQUEST["adresse"]);
$test->setCp($_REQUEST["cp"]);
$test->setVille($_REQUEST["ville"]);
$test->setTlfn($_REQUEST["tlfn"]);
$test->setMessage($_REQUEST["message"]);


try {
    $data = $db->createTestDrive($test);

    if($data){
        setLastInsertId($data);
        produceResult("Compte utilisateur créé avec succès");
    }else{
        produceError("Verifier vos Données");
    }
} catch (Exception $th) {
    produceError($th->getMessage());
}




?>