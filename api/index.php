<?php 

$url = trim($_SERVER["REQUEST_URI"],'/');

$url_clean = explode("/", $url);

function logMessageAccess($message){
    $message = date('d/m/Y H:i:s').' '.$message.PHP_EOL;
    file_put_contents("../log/access.txt", $message, FILE_APPEND | LOCK_EX);
}

if(sizeof($url_clean) !== 4){
    header("Location: ../");
    exit();
}else{
    $action = $url_clean[sizeof($url_clean)-1];
    $pos = strpos($action,'?');
    if($pos){
        $temp = explode("?",$action);
        $action = $temp[0];
    }
    $page = "";
    if($_SERVER["REQUEST_METHOD"] === "GET"){
        $page .= './get'.ucwords($action).".php";
    }elseif($_SERVER["REQUEST_METHOD"] === "POST"){
        $page .= './create'.ucwords($action).".php";
    }elseif($_SERVER["REQUEST_METHOD"] === "DELETE"){
        $page .= './delete'.ucwords($action).".php";
    }elseif($_SERVER["REQUEST_METHOD"] === "PUT"){
        $page .= './update'.ucwords($action).".php";
    }

    if(file_exists($page)){
        logMessageAccess("Accès à la page : ".$page);
        require $page;
    }else{
        $message = "404 Tentative d'accès à la page : ".$page;
        logMessageAccess($message);
        require '404.php';
    }

    //var_dump($page);exit();
    


}

//var_dump($action);
//echo "Bonne nouvelle";

?>