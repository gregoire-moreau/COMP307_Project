<?php
$pDateQuery = "INSERT INTO playdates(dog1, dog2, accepted, date) VALUES ((SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID=?)),?, false, ?);";
try{
    
    $stmt  = $GLOBALS['mysqli']->prepare($pDateQuery);
    $stmt->bind_param('sd', $_COOKIE["SessionID"],$dogData["dogID"], $dogData["date"]);
    $stmt->execute(); 
    echo '{"status":true}';
}catch (Exception $e) {
    echo '{"status":false}';
}