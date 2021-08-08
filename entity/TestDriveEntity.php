<?php

/**
 * userEntity.php
 * @author HYUNDAI-APP-WEB
 * Site Web : 
 */

class TestDriveEntity{

    protected $idTest;

    protected   $model;

    protected   $email;

    protected   $sexe;

    protected   $firstname;

    protected   $lastname;

    protected   $message;

    protected   $adresse;

    protected   $ville;

    protected   $tlfn;

    protected   $cp;
    
    protected   $createdAt;

    function getIdTest() { 
        return $this->idTest; 
   } 

   function setIdTest($idTest) {  
       $this->idTest = $idTest; 
   } 

   function getModel() { 
        return $this->model; 
   } 

   function setModel($model) {  
       $this->model = $model; 
   } 

   function getEmail() { 
        return $this->email; 
   } 

   function setEmail($email) {  
       $this->email = $email; 
   } 

   function getSexe() { 
        return $this->sexe; 
   } 

   function setSexe($sexe) {  
       $this->sexe = $sexe; 
   } 
   
   function getFirstname() { 
        return $this->firstname; 
   } 

   function setFirstname($firstname) {  
       $this->firstname = $firstname; 
   } 

   function getLastname() { 
        return $this->lastname; 
   } 

   function setLastname($lastname) {  
       $this->lastname = $lastname; 
   } 

   function getMessage() { 
        return $this->message; 
   } 

   function setMessage($message) {  
       $this->message = $message; 
   } 

   function getAdresse() { 
    return $this->adresse; 
    } 

    function setAdresse($adresse) {  
    $this->adresse = $adresse; 
    } 

    function getVille() { 
        return $this->ville; 
    } 

    function setVille($ville) {  
    $this->ville = $ville; 
    } 

   function getTlfn() { 
        return $this->tlfn; 
   } 

   function setTlfn($tlfn) {  
       $this->tlfn = $tlfn; 
   } 

   function getCp() { 
        return $this->cp; 
   } 

   function setCp($cp) {  
       $this->cp = $cp; 
   } 

   function getCreatedAt() { 
        return $this->createdAt; 
   } 

   function setCreatedAt($createdAt) {  
       $this->createdAt = $createdAt; 
   } 

}



	

	
?>