<?php
$checkQuery = "SELECT accepted FROM friends WHERE dog2 = (SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?)) AND dog1=?;";
$stmt =  $GLOBALS['mysqli']->prepare($checkQuery);
$stmt->bind_param('sd',$_COOKIE['SessionID'], $dogData["dogID"] );
$stmt->execute(); //First we check if a friendship exists and if it hasn't already been accepted
$result = $stmt->get_result();
$data = NULL;
while($row =  $result->fetch_assoc()){
    $data[] = $row;
}

if($data == NULL || $data[0]["accepted"]){
    echo encrypt('{"status":false}');
    return;
}

if ($dogData["answer"] == "true"){ //If the friends request was accepted
    $query = "UPDATE friends SET accepted = true WHERE dog2 = (SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?)) AND dog1=?;";
}else{
    $query = "DELETE FROM friends WHERE dog2 = (SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?)) AND dog1=?;";
}
$stmt =  $GLOBALS['mysqli']->prepare($query);
$stmt->bind_param('sd',$_COOKIE['SessionID'], $dogData["dogID"] );
$stmt->execute();

echo encrypt('{"status":true}');