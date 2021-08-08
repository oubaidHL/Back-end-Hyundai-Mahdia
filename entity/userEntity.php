<?php

/**
 * userEntity.php
 * @author HYUNDAI-APP-WEB
 * Site Web : 
 */

class UserEntity{

    protected $idUser;

    protected   $pseudo;

    protected   $email;

    protected   $sexe;

    protected   $password;

    protected   $firstname;

    protected   $lastname;

    protected   $description;

    protected   $adresseLivraison;

    protected   $adresseFacturation;

    protected   $tel;

    protected   $image;

    protected   $dateBirth;
    
    protected   $createdAt;

    function getIdUser() { 
        return $this->idUser; 
   } 

   function setIdUser($idUser) {  
       $this->idUser = $idUser; 
   } 

   function getPseudo() { 
        return $this->pseudo; 
   } 

   function setPseudo($pseudo) {  
       $this->pseudo = $pseudo; 
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

   function getPassword() { 
        return $this->password; 
   } 

   function setPassword($password) {  
       $this->password = $password; 
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

   function getDescription() { 
        return $this->description; 
   } 

   function setDescription($description) {  
       $this->description = $description; 
   } 

   function getAdresseLivraison() { 
    return $this->adresseLivraison; 
    } 

    function setAdresseLivraison($adresseLivraison) {  
    $this->adresseLivraison = $adresseLivraison; 
    } 

    function getAdresseFacturation() { 
        return $this->adresseFacturation; 
    } 

    function setAdresseFacturation($adresseFacturation) {  
    $this->adresseFacturation = $adresseFacturation; 
    } 

   function getTel() { 
        return $this->tel; 
   } 

   function setTel($tel) {  
       $this->tel = $tel; 
   } 

   function getImage() { 
    return $this->image; 
} 

    function setImage($image) {  
   $this->image = $image; 
    }

   function getDateBirth() { 
        return $this->dateBirth; 
   } 

   function setDateBirth($dateBirth) {  
       $this->dateBirth = $dateBirth; 
   } 

   function getCreatedAt() { 
        return $this->createdAt; 
   } 

   function setCreatedAt($createdAt) {  
       $this->createdAt = $createdAt; 
   } 

}



	

	
?>