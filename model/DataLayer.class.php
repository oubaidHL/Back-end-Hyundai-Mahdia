<?php

/**
 * DataLayer.class.php
 * @author HYUNDAI-APP-WEB
 * Site Web :
 */

class DataLayer{

    private $connexion;


    function __construct()
    {
        $var = "mysql:host=".HOST.";db_name=".DB_NAME;
        

        try {
            $this->connexion = new PDO($var,DB_USER,DB_PASSWORD);
            //echo "connexion réussie";

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Méthode permettant d'authentifier un utilisateur 
     * @param UserEntity $user Objet métier décrivant un utilisateur 
     * @return UserEntity $user Objet métier décrivant l'utilisateur authentifié
     * @return FALSE En cas d'échec d'authentification
     * @return NULL Exception déclenchée 
    */
    function authentifier(UserEntity $user){
        $sql = "SELECT * FROM ".DB_NAME.".`customers` WHERE email = :email";

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':email'=>$user->getEmail()
            ));
            

            $data = $result->fetch(PDO::FETCH_OBJ);

            if($data && ($data->password == sha1($user->getPassword()))){
                // authentification réussie
                $user->setIdUser($data->idUser);
                $user->setSexe($data->sexe);
                $user->setPseudo($data->pseudo);
                $user->setImage($data->image);
                $user->setFirstname($data->firstname);
                $user->setLastname($data->lastname);
                $user->setPassword(NULL);
                $user->setAdresseFacturation($data->adresse_facturation);
                $user->setAdresseLivraison($data->adresse_livraison);
                $user->setTel($data->tel);
                $user->setDateBirth($data->dateBirth);

                return $user;

            }else{
                // authentification échouée
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    
    /**
     * Methode permettant d'authentifier un administrateur en BD 
     * @param AdminEntity $user Objet métier décrivant un admin
     * @return TRUE Persistance réussie
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function authAdmin(AdminEntity $user){
        $sql = "SELECT * FROM ".DB_NAME.".`admins` WHERE email = :email";
       // echo  $sql;exit();
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':email'=>$user->getEmail()
            ));
            

            $data = $result->fetch(PDO::FETCH_OBJ);

            if($data && ($data->password == sha1($user->getPassword()))){
                // authentification réussie
                $user->setAdminId($data->adminId);
                $user->setFirstname($data->firstname);
                $user->setLastname($data->lastname);
                $user->setPseudo($data->pseudo);
                $user->setPassword(NULL);
                $user->setImage($data->image);
                $user->setTel($data->tel);
                $user->setCreatedAt($data->createdAt);
                $user->setDateBirth($data->dateBirth);

                return $user;

            }else{
                // authentification échouée
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    
    /**
     * Methode permettant de créer un utilisateur en BD 
     * @param UserEntity $user Objet métier décrivant un un utilisateur
     * @return TRUE Persistance réussie
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */

    function createUser(UserEntity $user){
        $sql = "INSERT INTO ".DB_NAME.".`customers` (sexe,pseudo,email,password,firstname,lastname,dateBirth)
         VALUES (:sexe,:pseudo,:email,:password,:firstname,:lastname,:dateBirth)";
         try {
             $result = $this->connexion->prepare($sql);
             $data = $result->execute(array(
                ':sexe' => $user->getSexe(),
                ':pseudo' => $user->getPseudo(),
                ':email' => $user->getEmail(),
                ':password' => sha1($user->getPassword()),
                ':firstname' => $user->getFirstname(),
                ':lastname' => $user->getLastname(),
                ':dateBirth' => $user->getDateBirth()
             ));
             //var_dump($sql);
             if($data){
                 return $this->connexion->lastInsertId();
             }else {
                 return FALSE;
             }
         } catch (PDOException $th) {
             return NULL;
         }
    }

    /**
     * Methode permettant de créer une categorie en BD 
     * @param CategoryEntity $category Objet métier décrivant une categorie
     * @return TRUE Persistance réussie
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function createCategory(CategoryEntity $category){
        $sql = "INSERT INTO ".DB_NAME.".`category`(`name`,`icon`) VALUES (:name,:icon)";

        try {
            $result = $this->connexion->prepare($sql);
            $data = $result->execute(array(
                ':name' => $category->getName(),
                ':icon' => $category->getIcon()
            ));
            if($data){
                return $this->connexion->lastInsertId();
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de créer un produit en BD 
     * @param ProductEntity $product Objet métier décrivant un product
     * @return TRUE Persistance réussie
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function createProduct(ProductEntity $product){
        $sql ="INSERT INTO ".DB_NAME.".`products`(`name`, `description`, `price`, `stock`, `idCategory`, `image`) 
        VALUES (:name,:description,:price,:stock,:idCategory,:image)";
        try {
            $result = $this->connexion->prepare($sql);
            $data = $result->execute(array(
                ':name'=> $product->getName(),
                ':description' => $product->getDescription(),
                ':price' => $product->getPrice(),
                ':stock' => $product->getStock(),
                ':idCategory' => $product->getCategory(),
                ':image'=> $product->getImage()
            ));
            if($data){
                return $this->connexion->lastInsertId();
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }

    }
    /**
     * Methode permettant de créer une commande en BD 
     * @param OrdersEntity $order un objet metier décrivant une commande
     * @return TRUE Persistance réussie
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function createOrders(OrdersEntity $orders){
        $sql = "INSERT INTO ".DB_NAME.".`orders`(`idUser`, `idProduct`, `quantity`, `price`)
         VALUES (:idUser,:idProduct,:quantity,:price)";

        try {
            $result = $this->connexion->prepare($sql);
            $data = $result->execute(array(
                'idUser'=>$orders->getIdUser(),
                ':idProduct'=>$orders->getIdProduct(),
                ':quantity' => $orders->getQuantity(),
                ':price' => $orders->getPrice()
                
            ));
            if($data){
                return $this->connexion->lastInsertId();
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

     /**
     * Methode permettant de créer un Test Drive demande en BD 
     * @param TestDriveEntity $test Objet métier décrivant un un Test Drive 
     * @return TRUE Persistance réussie
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */

    function createTestDrive(TestDriveEntity $test){
        $sql = "INSERT INTO ".DB_NAME.".`testdrive` (`model` , `sexe` , `email` , `adresse` , `firstname` , `lastname` , `cp` , `ville` , `tlfn` , `message`)
         VALUES (:model,:sexe,:email,:adresse,:firstname,:lastname,:cp,:ville,:tlfn,:message)";
         try {
             $result = $this->connexion->prepare($sql);
             $data = $result->execute(array(
                'sexe' => $test->getSexe(),
                'model' => $test->getModel(),
                'email' => $test->getEmail(),
                'adresse' => $test->getAdresse(),
                'firstname' => $test->getFirstname(),
                'lastname' => $test->getLastname(),
                'cp' => $test->getCp(),
                'ville' => $test->getVille(),
                'tlfn' => $test->getTlfn(),
                'message' => $test->getMessage(),
             ));
             //var_dump($sql);
             if($data){
                 return $this->connexion->lastInsertId();
             }else {
                 return FALSE;
             }
         } catch (PDOException $th) {
             return NULL;
         }
    }

    /**
     * Methode permettant de récupérer les utilisateur dans BD 
     * @param VOID ne prend pas de paramètre
     * @return ARRAY Tableau contenant les données utilisateurs
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */

    function getUsers(){
        $sql = "SELECT * FROM ".DB_NAME.".`customers`";

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();


            while($data = $result->fetch(PDO::FETCH_OBJ)){
                $user = new UserEntity();
                $user->setIdUser($data->idUser);
                $user->setEmail($data->email);
                $user->setSexe($data->sexe);
                $user->setFirstname($data->firstname);
                $user->setLastname($data->lastname);
                $user->setPseudo($data->pseudo);
                $user->setTel($data->tel);
                $user->setPassword(sha1($data->password));
                $user->setImage($data->image);
                $user->setAdresseLivraison($data->adresse_livraison);
                $user->setAdresseFacturation($data->adresse_facturation);
                $user->setDateBirth($data->dateBirth);
                $users[] = $user;
            }

            if($users){
                return $users;
            }else{
                return FALSE;
            }


        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de récupérer les catégories dans BD 
     * @param VOID ne prend pas de paramètre
     * @return ARRAY Tableau contenant les catégories
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function getUserById($email){
        $sql = "SELECT * FROM ".DB_NAME.".`customers` WHERE email=".($email);
        //echo  $sql;exit();

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();


            while($data = $result->fetch(PDO::FETCH_OBJ)){
                $user = new UserEntity();
                $user->setIdUser($data->idUser);
                $user->setEmail($data->email);
                $user->setSexe($data->sexe);
                $user->setFirstname($data->firstname);
                $user->setLastname($data->lastname);
                $user->setPseudo($data->pseudo);
                $user->setTel($data->tel);
                $user->setPassword(sha1($data->password));
                $user->setImage($data->image);
                $user->setAdresseLivraison($data->adresse_livraison);
                $user->setAdresseFacturation($data->adresse_facturation);
                $user->setDateBirth($data->dateBirth);
                $users[] = $user;
            }

            if($users){
                return $users;
            }else{
                return FALSE;
            }


        } catch (PDOException $th) {
            return NULL;
        }
    }

     /**
     * Methode permettant de récupérer les commandes dans BD 
     * @param VOID ne prend pas de paramètre
     * @return ARRAY Tableau contenant les commande
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function getCategory(){
        $sql = "SELECT * FROM ".DB_NAME.".`category`";

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $categories = [];

            while($data = $result->fetch(PDO::FETCH_OBJ)){
                $category = new CategoryEntity();
                $category->setIdCategory($data->idCategory);
                $category->setName($data->name);
                $category->setIcon($data->icon);

                $categories[] = $category;
            }

            if($categories){
                return $categories;
            }else{
                return FALSE;
            }


        } catch (PDOException $th) {
            return NULL;
        }
    }

     /**
     * Methode permettant de récupérer les produits dans BD 
     * @param VOID ne prend pas de paramètre
     * @return ARRAY Tableau contenant les produits
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function getProduct(){
        $sql = "SELECT * FROM ".DB_NAME.".`products`";
        //echo  $sql;exit();
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $products = [];
         

            while($data = $result->fetch(PDO::FETCH_OBJ)){
               $product = new ProductEntity();
               $product->setIdProduct($data->idProduct);
               $product->setName($data->name);
               $product->setDescription($data->description);
               $product->setPrice($data->price);
               $product->setStock($data->stock);
               $product->setImage($data->image);
               $product->setCategory($data->idCategory);
               $product->setCreatedAt($data->createdAt);

               $products[] = $product;
            }

            if($products){
                return $products;
            }else{
                return FALSE;
            }


        } catch (PDOException $th) {
            return NULL;
        }
    }

    function getProductById($product){
        $sql = "SELECT * FROM ".DB_NAME.".`products` WHERE idProduct=".$product->getIdProduct();
        //echo  $sql;exit();
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $products = [];
       
        if($var){
            $data = $result->fetch(PDO::FETCH_OBJ);
            $product = new ProductEntity();
            $product->setIdProduct($data->idProduct);
            $product->setName($data->name);
            $product->setDescription($data->description);
            $product->setPrice($data->price);
            $product->setStock($data->stock);
            $product->setImage($data->image);
            $product->setCategory($data->idCategory);
            $product->setCreatedAt($data->createdAt);
            $products[] = $product;
        }
        if($products){
            return $products;
        }else{
            return FALSE;
        }

        } catch (PDOException $th) {
            return NULL;
        }
    }

     /**
     * Methode permettant de récupérer les commandes dans BD 
     * @param VOID ne prend pas de paramètre
     * @return ARRAY Tableau contenant les commande
     * @return FALSE Echec de la persistance
     * @return NULL Exception déclenchée
     */
    function getOrders(){
        $sql = "SELECT * FROM ".DB_NAME.".`orders`";

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            $orders = [];

            while($data = $result->fetch(PDO::FETCH_OBJ)){
                $order = new OrdersEntity();
                $order->setIdOrder($data->idOrder);
                $order->setIdUser($data->idUser);
                $order->setStatus($data->status);
                $order->setIdProduct($data->idProduct);
                $order->setPrice($data->price);
                $order->setQuantity($data->quantity);
                $order->setCreatedAt($data->createdAt);


                $orders[] = $order;
            }

            if($orders){
                return $orders;
            }else{
                return FALSE;
            }


        } catch (PDOException $th) {
            return NULL;
        }
    }
    

     /**
     * Methode permettant de mettre à jour des données d'un utilisateur dans BD 
     * @param UserEntity $user Objet métier décrivant un utilisateur
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL Exception déclenchée
     */
    function updateUsers(UserEntity $user){
        $sql ="UPDATE ".DB_NAME.".`customers` SET ";
        try {
            $sql .= " Pseudo = '".$user->getPseudo()."',";
            $sql .= " email = '".$user->getEmail()."',";
            $sql .= " image = '".$user->getImage()."',";
            $sql .= " tel = '".$user->getTel()."',";
            $sql .= " dateBirth = '".$user->getDateBirth()."',";
            $sql .= " password = '".$user->getPassword()."',";
            $sql .= " firstname = '".$user->getFirstname()."',";
            $sql .= " lastname = '".$user->getLastname()."',";
            $sql .= " adresse_facturation = '".$user->getAdresseFacturation()."',";
            $sql .= " adresse_livraison = '".$user->getAdresseLivraison()."'";

            $sql .= " WHERE idUser=".$user->getIdUser(); 

            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            //var_dump($sql); exit();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }


        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de mettre à jour un produit dans BD 
     * @param ProductEntity $product Objet métier décrivant un produit
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL Exception déclenchée
     */
    function updateProduct(ProductEntity $product){
        $sql = "UPDATE ".DB_NAME.".`products` SET `name`=:name,`description`=:description,`price`=:price,
        `stock`=:stock,`idCategory`=:idCategory,`image`=:image WHERE idProduct=:idProduct";
         try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':idProduct' => $product->getIdproduct(),
                ':name' => $product->getName(),
                ':description' => $product->getDescription(),
                ':price' => $product->getPrice(),
                ':stock' => $product->getStock(),
                ':idCategory' => $product->getCategory(),
                ':image'=>$product->getImage()
               
            ));
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        } 
    }

    /**
     * Methode permettant de mettre à jour une catégorie dans BD 
     * @param CategoryEntity $category Objet métier décrivant une categorie
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL Exception déclenchée
     */
    function updateCategory(CategoryEntity $category){
        $sql = "UPDATE ".DB_NAME.".`category` SET `name`=:name, `icon`=:icon WHERE idCategory=:idCategory";
        
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':name' => $category->getName(),
                ':icon' => $category->getIcon(),
                ':idCategory' => $category->getIdcategory()
            ));
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }

        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de mettre à jour une commande dans BD 
     * @param OrdersEntity $order Objet métier décrivant une commande
     * @return TRUE Mise à jour réussie
     * @return FALSE Echec de la mise à jour
     * @return NULL Exception déclenchée
     */
    function updateOrders(OrdersEntity $order){
        $sql = "UPDATE ".DB_NAME.".`orders` SET `status`=:status
         WHERE idOrder=:idOrder";
        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute(array(
                ':idOrder' => $order->getIdOrder(),
                ':status' => $order->getStatus()
            ));
            //var_dump($var);
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

       

    /**
     * Methode permettant de supprimer un utilisateur dans BD 
     * @param UserEntity $user Objet métier décrivant un utilisateur
     * @return TRUE Suppression réussie
     * @return FALSE Echec de la suppression
     * @return NULL Exception déclenchée
     */
    function deleteUsers(UserEntity $user){
        $sql = "DELETE FROM ".DB_NAME.".`customers` WHERE idUser=".$user->getIdUser();

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            //var_dump($sql); exit();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de supprimer un produit dans BD 
     * @param ProductEntity $product Objet métier décrivant un produit
     * @return TRUE Suppression réussie
     * @return FALSE Echec de la suppression
     * @return NULL Exception déclenchée
     */
    function deleteProduct(ProductEntity $product){
        $sql = "DELETE FROM ".DB_NAME.".`products` WHERE idProduct=".$product->getIdProduct();

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            //var_dump($sql); exit();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de supprimer une categorie dans BD 
     * @param CategoryEntity $user Objet métier décrivant une categorie
     * @return TRUE Suppression réussie
     * @return FALSE Echec de la suppression
     * @return NULL Exception déclenchée
     */
    function deleteCategory(CategoryEntity $category){
        $sql = "DELETE FROM ".DB_NAME.".`category` WHERE idCategory=".$category->getIdCategory();

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            //var_dump($sql); exit();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

    /**
     * Methode permettant de supprimer une commande dans BD 
     * @param OrdersEntity $order Objet métier décrivant une commande
     * @return TRUE Suppression réussie
     * @return FALSE Echec de la suppression
     * @return NULL Exception déclenchée
     */
    function deleteOrders(OrdersEntity $order){
        $sql = "DELETE FROM ".DB_NAME.".`orders` WHERE idOrder=".$order->getIdOrder();

        try {
            $result = $this->connexion->prepare($sql);
            $var = $result->execute();
            //var_dump($sql); exit();
            if($var){
                return TRUE;
            }else{
                return FALSE;
            }
        } catch (PDOException $th) {
            return NULL;
        }
    }

}


?>