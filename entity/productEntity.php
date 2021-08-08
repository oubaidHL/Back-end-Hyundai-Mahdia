<?php

/**
 * productEntity.php
 * @author HYUNDAI-APP-WEB
 * site Web :
 */
class ProductEntity{

    protected  $idProduct;

    protected  $name;

    protected   $description;

    protected   $price;

    protected   $stock;

    protected   $idCategory;

    protected  $image;
    
    protected  $createdAt;

    function getIdProduct() { 
        return $this->idProduct; 
   } 

   function setIdProduct($idProduct) {  
       $this->idProduct = $idProduct; 
   } 

   function getName() { 
        return $this->name; 
   } 

   function setName($name) {  
       $this->name = $name; 
   } 

   function getDescription() { 
        return $this->description; 
   } 

   function setDescription($description) {  
       $this->description = $description; 
   } 

   function getPrice() { 
        return $this->price; 
   } 

   function setPrice($price) {  
       $this->price = $price; 
   } 

   function getStock() { 
        return $this->stock; 
   } 

   function setStock($stock) {  
       $this->stock = $stock; 
   } 

   function getCategory() { 
        return $this->idCategory; 
   } 

   function setCategory($idCategory) {  
       $this->idCategory = $idCategory; 
   } 

   function getImage() { 
        return $this->image; 
   } 

   function setImage($image) {  
       $this->image = $image; 
   } 

   function getCreatedAt() { 
        return $this->createdAt; 
   } 

   function setCreatedAt($createdAt) {  
       $this->createdAt = $createdAt; 
   } 

}



	
?>