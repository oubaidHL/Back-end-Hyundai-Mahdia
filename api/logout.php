<?php 
session_start();
require 'commun_services.php';

if(isset($_SESSION['ident'])){
    unset($_SESSION['ident']);
    session_destroy();
    produceResult("Utilisateur déconnecté avec succès");
    return;
}else{
    produceError("Utilisateur non connecté");
}


?>