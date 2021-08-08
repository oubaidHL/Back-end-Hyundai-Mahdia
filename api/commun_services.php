<?php 
date_default_timezone_set("Africa/Tunis");
header("Content-type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding, X-Auth-Token, content-type');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Credentials: true');
header("Access-Control-Max-Age: 3600");


define("API", dirname(__FILE__));
define("ROOT", dirname(API));
define("SP",DIRECTORY_SEPARATOR);
define("CONFIG", ROOT.SP."config"); 
define("MODEL", ROOT.SP."model");
define("ENTITY", ROOT.SP."entity");
define("API_KEY", 'adsffsdfds6b-6727-46f4-8bee-2c6ce6293e41');
require CONFIG.SP."config.php";

spl_autoload_register(function ($class) {
    if(file_exists(ENTITY.SP. $class . '.php')){
        require_once ENTITY.SP. $class . '.php';
    }else{
        require_once MODEL.SP. $class . '.class.php';
    }
    
});

$db = new DataLayer();

function answer($response){
    global $_REQUEST;
    $response['args'] = $_REQUEST;
    unset($response['args']['password']);
    unset($response['args']['API_KEY']);
    $response['time'] = date('d/m/Y H:i:s');
    echo json_encode($response);
}

function setLastInsertId($id){
    $_REQUEST['lastInsertId'] = $id;
}
function produceError($message){
    logMessage($message);
    answer(['status'=>404,'message'=>$message]);
}

function produceErrorAuth(){
    answer(['status'=>401,'message'=>'Authentification requis !']);
}

function produceErrorRequest(){
    logMessage("Vérifier Vos donnéees");
    answer(['status'=>400,'message'=>'Vérifier Vos donnéees']);
}
function userErrorRequest(){
    logMessage("Requete mal formulée");
    answer(['status'=>400,'message'=>'Email already exist !']);
}

function produceResult($result){
    answer(['status'=>200,'result'=>$result]);
}

function clearData($objetMetier){
    $objetMetier = (array)$objetMetier;

    $result=[];

    foreach ($objetMetier as $key => $value) {
        $result[substr($key,3)]= $value;
    }
    return $result;
}

function clearDataArray($array_obj_met){
    $result = [];
    foreach ($array_obj_met as $key => $value) {
        $result[$key] = clearData($value);
    }
    return $result;
}

function controlAccess(){
    global $_REQUEST;
    if(!isset($_REQUEST['API_KEY']) || empty($_REQUEST['API_KEY'])){
        produceErrorAuth();
        logMessage('Un utilisateur a tenté sans clé API');
        exit();
    }elseif ($_REQUEST['API_KEY'] !== API_KEY) {
        produceError("ApI_KEY incorrecte !");
        logMessage('Un utilisateur a tenté une clé API Incorrecte');
        exit();
    }
    
}

function logMessage($message){
    $data = implode($_REQUEST);
    $message = date('d/m/Y H:i:s').' '.$message.PHP_EOL;
    file_put_contents("../log/log.txt", $message, FILE_APPEND | LOCK_EX);
}

controlAccess();






?>