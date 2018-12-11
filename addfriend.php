<?php
$friendQuery = "INSERT INTO friends(dog1, dog2, accepted) VALUES ((SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID=?)),?, false);";
try{
    
    $stmt  = $GLOBALS['mysqli']->prepare($friendQuery);
    $stmt->bind_param('sd', $_COOKIE["SessionID"],$dogData["dogID"]);
    $stmt->execute(); 
    echo '{"status":true}';
}catch (Exception $e) {
    echo '{"status":false}';
}