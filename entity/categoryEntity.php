<?php

/**
 * categoryEntity.php
 * @author HYUNDAI-APP-WEB
 * site Web : 
 */
class CategoryEntity{

    /**
     * Identifiant de la categorie
     */
    protected $idCategory;

    /**
     * Le nom de la categorie
     */
    protected $name;

    /**
     * Le nom de la categorie
     */
    protected $icon = null;


    /**
     *  Getter et Setter
     */
    function getIdCategory() { 
        return $this->idCategory; 
    } 

    function setIdCategory($idCategory) {  
        $this->idCategory = $idCategory; 
    } 

    function getIcon() { 
        return $this->icon; 
    } 

    function setIcon($icon) {  
        $this->icon = $icon; 
    } 

    function getName() { 
            return $this->name; 
    } 

    function setName($name) {  
        $this->name = $name; 
    } 

 


}



	
?>