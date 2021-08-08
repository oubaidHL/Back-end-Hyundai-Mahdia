<?php
require 'config/config.php';
define("BASE_URL", dirname($_SERVER['SCRIPT_NAME']));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
 <style>
   
     a{
       color: black;
     }
     p{
      background-color: #fff; 
      font-size: 35px;
      border: 1px solid rgba(0,0,0,.1);
      box-shadow:
        0 10px 20px rgba(0,0,0,.22),
        0 14px 56px rgba(0,0,0,.25);
      
     }
     p span:nth-child(1){
       display: inline-block;
        font-size: 44px;
        font-weight: 700;
        min-width: 200px;
        padding: 6px 15px;
        text-align: center;
        color: #fff;
     }
     p span:nth-child(2){
      font-size: 35px;
      font-weight: 700;
     }
     .get{
      background-color: #3caab5;
      text-transform: uppercase;
     }
     .post{
      background-color: #78bc61;
      text-transform: uppercase;
     }
     .delete{
      background-color: #f93e3e;
      text-transform: uppercase;
     }
     .put{
      background-color: #fca130;
      text-transform: uppercase;
     }
     nav.navbar{
         background-color: #288690 !important;
     }

 </style>
    <title>API HYUNDAI !</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <a class="navbar-brand" href="#">HYUNDAI API</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
    <div class="container">
      <h1 class="text-center display-4">Documentation API HYUNDAI</h1>
  
    <?php
        
        // Ouverture du dossier API
        foreach ($_ROUTES as $key => $entity) {
            $response = "<div id='$entity' class='display-4'><h4>".ucwords($entity)."</h4>";
            foreach ($METHODES as $methode => $description) {
              $response .= "<p><span class='$methode'> $methode </span> 
              <span class='url'>
              <a href='".BASE_URL."/api/$entity'target='_blank'> /api/$entity</a>
              </span> 
              ".$description['description']." : $entity</p>";
            }
            echo $response.'</div>';
        }

    ?>

</body>

</html>