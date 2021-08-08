  <?php
    /**
     * config.php
     * @author HYUNDAI-APP-WEB
     * Site Web : 
     */

    define("DB_USER","root");
    define("DB_PASSWORD","");
    define("HOST", "localhost");
    define("DB_NAME", "isimapfe");

    $METHODES = [
      "get"=>["description"=>"Lire les données","prefixe"=>"get" ],
      "post"=>["description"=>"Créer une donnée","prefixe"=>"create" ],
      "put"=>["description"=>"Mettre à jour une donnée","prefixe"=>"update" ],
      "delete"=>["description"=>"Supprimer une donnée", "prefixe"=>"delete"],
       
    ];

    $_ROUTES = ["products", "category", "orders","customers","admins","testdrive"];

?>