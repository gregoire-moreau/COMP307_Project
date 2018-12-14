<?php
$checkQuery =  "SELECT * FROM friends WHERE dog1 = (SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID=?)) AND dog2 = ?";
$friendQuery = "INSERT INTO friends(dog1, dog2, accepted) VALUES ((SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID=?)),?, false);";
try{
    $stmt  = $GLOBALS['mysqli']->prepare($checkQuery);
    $stmt->bind_param('sd', $_COOKIE["SessionID"],$dogData["dogID"]); //Avoid sql injection
    $stmt->execute(); //First we check if the friends request between the two dogs doesn't already exist
    $result = $stmt->get_result();
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    if($data != NULL){
        echo encrypt('{"status":false}');
        return;
    }

    $stmt  = $GLOBALS['mysqli']->prepare($friendQuery); //We create the friends request
    $stmt->bind_param('sd', $_COOKIE["SessionID"],$dogData["dogID"]);
    $stmt->execute(); 
    echo encrypt('{"status":true}');
}catch (Exception $e) {
    echo encrypt('{"status":false}');
}