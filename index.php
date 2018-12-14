<?php
require __DIR__ . '/vendor/autoload.php';
$app = new Slim\App;
require_once('dbaccess.php');
include 'encrypt_decrypt.php';

$app->get('/', function ($request, $response) {
    if (checkSessionID()){
        include 'main.html'; //The user is logged in, he receives the main page
    }
    else{
        include 'ABNBHome.html'; //The user is not logged in so he receives the login page
    }
});

$app->post('/signup', function($request, $response) {
    $dataSignup =  json_decode(decrypt(file_get_contents('php://input')), true); //We decrypt and decode the data that we have received for the signup
    $toRet = array("status"=>"not done", "field"=>"", "errorMessage"=>"");
    $newUser = false;
    require_once('signup.php');
    if($newUser){
        require_once('newdog.php'); //If the signup of the user worked, we create a dog for that user
    }
});

$app->post('/login', function($request, $response) {
    $dataLogin =  json_decode(decrypt(file_get_contents('php://input')), true); //We decrypt and decode the data that we have received for the login
    $success = false;
    if(checkSessionID()){ //If one user is already logged in, delete his session
        require_once('logout.php');
    }
    require_once('login.php');
    if($success){
        do{
            $newID = randomString(); //We create a sessionId so that we can identify the user on every page of the website and send him his information
            $checkQuery = "SELECT * FROM sessions WHERE SessionID = '$newID'";
            $result = $GLOBALS['mysqli']->query($checkQuery);
            $data = NULL;
            while($row =  $result->fetch_assoc()){
                $data[] = $row;
            }
        } while($data != NULL); //If this id is already used, we ask for another random String 
        $sessionQuery = "INSERT INTO sessions(SessionID, uname) VALUES ('$newID', ?) ON DUPLICATE KEY UPDATE SessionID = VALUES(SessionID); ";
        $stmt = $GLOBALS['mysqli']->prepare($sessionQuery);
        $stmt->bind_param('s', $username); //We take precautions with the user's username to avoid possible sql injection
        $stmt->execute();
        setCookie("SessionID", $newID, false, "/", false); //We send the sessionID to the user, and specify that we want it sent for every page on the website
        echo encrypt('{"status":true}'); //We encrypt the data before we send it back
    }
});

$app->post('/profile', function($request, $response) {
    if (checkSessionID()){
        require_once('profile.php');
    }
});

$app->post('/playdates', function($request, $response) {
    if (checkSessionID()){
        require_once('playdates.php');
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
    $dogData =  json_decode(decrypt(file_get_contents('php://input')), true);
    require_once('addfriend.php');
});

$app->post('/acceptrequest', function($request, $response){
    $dogData =  json_decode(decrypt(file_get_contents('php://input')), true);
    require_once('accept_friendship.php');
});

$app->post('/accept_playdate', function($request, $response){
    $dogData =  json_decode(decrypt(file_get_contents('php://input')), true);
    require_once('accept_playdate.php');
});

$app->post('/playdate_request', function($request, $response){
    $dogData =  json_decode(decrypt(file_get_contents('php://input')), true);
    require_once('addplaydate.php');
});

$app->post('/main', function($request, $response){
    if(checkSessionID()){
        require_once('main.php');
    }
});

$app->get('/logout', function($request, $response){
    require_once('logout.php');
    include 'ABNBHome.html';
    return $response;   
});



$app->post('/test', function($request, $response){
    echo decrypt(file_get_contents('php://input'));
});

//Returns true if the SessionID cookie is set and valid
function checkSessionID(){
    if(!isSet($_COOKIE['SessionID'])){ //Is the cookie set?
        return false;
    }
    else {
        $checkCookieQuery = "SELECT uname FROM sessions WHERE SessionID=?;";
        $stmt = $GLOBALS['mysqli']->prepare($checkCookieQuery);
        $stmt->bind_param('s', $_COOKIE['SessionID']); //Avoid sql injection by cookie poisoning
        $stmt->execute(); 
        $result = $stmt->get_result();
        $data = NULL;
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        if($data == NULL){
            return false; //If the cookie doesn't correspond to a current session
        }
        else{
            return true;
        }
    }
}

//Provides a random string of length 10 using any lowercase letter and any digit
function randomString(){
    $characters = "abcdefghijklmnopqrstuvwxyz0123456789";
    $toRet = "";
    for($i = 0; $i<10; $i++){
        $toRet.= $characters[random_int(0, 35)];
    }
    return $toRet;
}

$app->run(); 
