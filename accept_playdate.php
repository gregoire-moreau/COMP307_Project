<?php
$checkQuery = "SELECT accepted FROM playdates WHERE dog2 = (SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?)) AND dog1=? AND date = ?;";
$stmt =  $GLOBALS['mysqli']->prepare($checkQuery);
$stmt->bind_param('sds',$_COOKIE['SessionID'], $dogData["dogID"], $dogData["date"] );
$stmt->execute(); //First we check if the playdate request exists and if it hasn't already been accepted
$result = $stmt->get_result();
$data = NULL;
while($row =  $result->fetch_assoc()){
    $data[] = $row;
}

if($data == NULL || $data[0]["accepted"]){
    echo encrypt('{"status":false}');
    return;
}

if ($dogData["answer"] == "true"){ //If the playdate request was accepted
    $query = "UPDATE playdates SET accepted = true WHERE dog2 = (SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?)) AND dog1=? AND date=?;";
}else{
    $query = "DELETE FROM playdates WHERE dog2 = (SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?)) AND dog1=? AND date=?;";
}
$stmt =  $GLOBALS['mysqli']->prepare($query);
$stmt->bind_param('sds',$_COOKIE['SessionID'], $dogData["dogID"] ,$dogData["date"] ); //Avoid sql injection
$stmt->execute();
echo encrypt('{"status":true}');