<?php
require __DIR__ . '/vendor/autoload.php';
$app = new Slim\App;
require_once('dbaccess.php');

$app->get('/', function ($request, $response) {
    if (checkSessionID()){
        include 'main.html';
    }
    else{
        include 'ABNBHome.html';
    }
});

$app->post('/signup', function($request, $response) {
    $dataSignup =  json_decode(file_get_contents('php://input'), true);
    $toRet = array("status"=>"not done", "field"=>"", "errorMessage"=>"");
    //require_once('dbaccess.php');
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
        do{
            $newID = randomString();
            $checkQuery = "SELECT * FROM sessions WHERE SessionID = '$newID'";
            $result = $GLOBALS['mysqli']->query($checkQuery);
            $data = NULL;
            while($row =  $result->fetch_assoc()){
                $data[] = $row;
            }
        } while($data != NULL);
        $sessionQuery = "INSERT INTO sessions(SessionID, uname) VALUES ('$newID', ?) ON DUPLICATE KEY UPDATE SessionID = VALUES(SessionID); ";
        $stmt = $GLOBALS['mysqli']->prepare($sessionQuery);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        setCookie("SessionID", $newID, false, "/", false);
        echo '{"status":true}';
    }
});

$app->post('/profile', function($request, $response) {
    if (checkSessionID()){
        require_once('profile.php');
    }
});

$app->post('/receive_image', function($request, $response) {
    file_put_contents("test.log", "heddre");
    if (checkSessionID()){
        require_once('receive_image.php');
    }
});

$app->post('/friends', function($request, $response) {
    if (checkSessionID()){
        require_once('friends.php');
    }
});

$app->post('/not_friends', function($request, $response) {
    if (checkSessionID()){
        require_once('pending_requests.php');
    }
});

$app->post('/friendrequest', function($request, $response){
    $dogData =  json_decode(file_get_contents('php://input'), true);
    require_once('addfriend.php');
});

$app->post('/acceptrequest', function($request, $response){
    $dogData =  json_decode(file_get_contents('php://input'), true);
    if ($dogData["answer"]){
        $query = "UPDATE friends SET accepted = true WHERE dog2 = (SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?)) AND dog1=?;";
    }else{
        $query = "DELETE FROM friends WHERE dog2 = (SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?)) AND dog1=?;";
    }
    $stmt =  $GLOBALS['mysqli']->prepare($query);
    $stmt->bind_param('sd',$_COOKIE['SessionID'], $dogData["dogID"] );
    $stmt->execute();
});

$app->post('/main', function($request, $response){
    if(checkSessionID()){
        $fnameQuery = "SELECT firstName as fname FROM users WHERE username = (SELECT uname FROM sessions WHERE SessionID = ?);";
        $stmt =  $GLOBALS['mysqli']->prepare($fnameQuery);
        $stmt->bind_param('s', $_COOKIE['SessionID']);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = NULL;
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        if($data == NULL){
            echo '{"status":false, "fname":"user"}';
        }
        else{
            echo '{"status":true, "fname":"'.$data[0]["fname"].'"}';
        }
    }
});

$app->get('/logout', function($request, $response){
    $query = "DELETE FROM sessions WHERE SessionID = ?;";
    $stmt = $GLOBALS['mysqli']->prepare($query);
    $stmt->bind_param('s', $_COOKIE['SessionID']);
    $stmt->execute();
    setcookie("SessionID", "", time()-3600);
    include 'ABNBHome.html';
    return $response;
});



$app->get('/test', function($request, $response){
    require_once('pending_requests.php');
});

function checkField($fieldVal){
    return !(strlen($fieldVal) == 0);
}

function checkSessionID(){
    if(!isSet($_COOKIE['SessionID'])){
        return false;
    }
    else {
        $checkCookieQuery = "SELECT uname FROM sessions WHERE SessionID=?;";
        $stmt = $GLOBALS['mysqli']->prepare($checkCookieQuery);
        $stmt->bind_param('s', $_COOKIE['SessionID']);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = NULL;
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        if($data == NULL){
            return false;
        }
        else{
            return true;
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
