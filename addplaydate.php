<?php
$checkQuery =  "SELECT * FROM playdates WHERE dog1 = (SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID=?)) AND dog2 = ? AND date = ?";
$pDateQuery = "INSERT INTO playdates(dog1, dog2, accepted, date, message) VALUES ((SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID=?)),?, false, ?, ?);";
try{
    $stmt  = $GLOBALS['mysqli']->prepare($checkQuery);
    $stmt->bind_param('sds', $_COOKIE["SessionID"],$dogData["dogID"], $dogData["date"]);
    $stmt->execute(); 
    $result = $stmt->get_result();
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    if($data != NULL){
        echo '{"status":false}';
        return;
    }
    $stmt  = $GLOBALS['mysqli']->prepare($pDateQuery);
    $stmt->bind_param('sdss', $_COOKIE["SessionID"],$dogData["dogID"], $dogData["date"], $dogData["message"]);
    $stmt->execute(); 
    echo '{"status":true}';
}catch (Exception $e) {
    echo '{"status":false}';
}