<?php
require 'commun_services.php'; 
for ($i=0; $i < 20; $i++) { 
    $user = new UserEntity();
    $user->setSexe(rand(1,2));
    $user->setPseudo("pseudo1");
    $user->setFirstname("oubaid ".$i);
    $user->setLastname("hlaimi  ".$i);
    $user->setEmail("oubaid".$i."@oubaidhl");
    $user->setPassword("test");
    $user->setDateBirth("1999-11-21");
    //$data = $db->createUser($user);
}