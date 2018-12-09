<?php
require __DIR__ . '/vendor/autoload.php';
$app = new Slim\App;
require_once('dbaccess.php');

$app->get('/', function ($request, $response) {
    if(!isSet($_COOKIE['SessionID'])){
        include 'ABNBHome.html';
        return $response;
    }
    else{
        $checkCookieQuery = "SELECT uname FROM sessions WHERE SessionID='".$_COOKIE['SessionID']."';";
        $result  = $GLOBALS['mysqli']->query($checkCookieQuery);
        $data = NULL;
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        if($data == NULL){
            include 'ABNBHome.html';
            return $response;
        }
        else{
            include 'main.html';
            return $response;
        }
    }
});

$app->post('/signup', function($request, $response) {
    $dataSignup =  json_decode(file_get_contents('php://input'), true);
    $toRet = array("status"=>"not done", "field"=>"", "errorMessage"=>"");
    require_once('dbaccess.php');
    $newUser = false;
    require_once('signup.php');
    if($newUser){
        require_once('newdog.php');
    }
});

$app->post('/login', function($request, $response) {
    $dataLogin =  json_decode(file_get_contents('php://input'), true);
    //require_once('dbaccess.php');
    $success = false;
    require_once('login.php');
    if($success){
        $newID = randomString();
        $sessionQuery = "INSERT INTO sessions(SessionID, uname) VALUES ('$newID', '$username') ON DUPLICATE KEY UPDATE SessionID = VALUES(SessionID); ";
        $GLOBALS['mysqli']->query($sessionQuery);
        setCookie("SessionID", $newID, false, "/", false);
        echo '{"status":true}';
    }
});

$app->post('/profile', function($request, $response) {
    if (checkSessionID()){
        require_once('profile.php');
    }
});

$app->post('/upload', function($request, $response) {
    if (checkSessionID()){
        require_once('receive_image.php');
    }
});

$app->post('/query', 'retrieve');
function retrieve(){
    require_once('dbaccess.php');
    $query = $_POST['query'];
    try{
        $result = $mysqli->query($query);
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        if (isset($data)){
            echo json_encode($data);
        }
    }catch (Exception $e) {
        echo 'Exception reçue : ',  $e->getMessage(), "\n";
    }
}

$app->get('/logout', function($request, $response){
    $query = "DELETE FROM sessions WHERE SessionID = '".$_COOKIE['SessionID']."';";
    $GLOBALS['mysqli']->query($query);
    setcookie("SessionID", "", time()-3600);
    include 'ABNBHome.html';
    return $response;
});

$app->get('/test', function($request, $response){
    //require_once('dbaccess.php');
    require_once('receive_image.php');
});

function checkField($fieldVal){
    return !(strlen($fieldVal) == 0);
}

function checkSessionID(){
    if(!isSet($_COOKIE['SessionID'])){
        return false;
    }
    else {
        $checkCookieQuery = "SELECT uname FROM sessions WHERE SessionID='".$_COOKIE['SessionID']."';";
        $result  = $GLOBALS['mysqli']->query($checkCookieQuery);
        $data = NULL;
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        if($data == NULL){
            include 'ABNBHome.html';
            return $false;
        }
        else{
            return $true;
        }
    }
}

function randomString(){
    $characters = "abcdefghijklmnopqrstuvwxyz0123456789";
    $toRet = "";
    for($i = 0; $i<10; $i++){
        $toRet.= $characters[random_int(0, 35)];
    }
    return $toRet;
}

$app->run(); 
