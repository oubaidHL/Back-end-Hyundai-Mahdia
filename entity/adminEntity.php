<?php

/**
 * userEntity.php
 * @author HYUNDAI-APP-WEB
 * Site Web : 
 */

class AdminEntity{

    protected $adminId;

    protected   $pseudo;

    protected   $email;

    protected   $password;

    protected   $firstname;

    protected   $lastname;

    protected   $tel;

    protected   $image;

    protected   $dateBirth;
    
    protected   $createdAt;

    function getAdminId() { 
        return $this->adminId; 
   } 

   function setAdminId($adminId) {  
       $this->adminId = $adminId; 
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