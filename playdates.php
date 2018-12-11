<?php
$userQuery = "SELECT firstName, id, name FROM users, dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionId = ?) AND username = (SELECT uname FROM sessions WHERE SessionId = ?);";
try{
    $stmt  = $GLOBALS['mysqli']->prepare($userQuery);
    $stmt->bind_param('ss', $_COOKIE['SessionID'],$_COOKIE['SessionID']);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    if($data == NULL){
     return $response;
    }
    $fname = $data[0]["firstName"];
    $dogID = $data[0]["id"];
    $dogName = $data[0]["name"];
    $requestedPlaydateQuery = "SELECT dogs.id as id, name as dname, image, date, message FROM `playdates`, dogs WHERE dog2=$dogID AND dogs.id = playdates.dog1 AND accepted = false; ";
    $result = $GLOBALS['mysqli']->query($requestedPlaydateQuery);
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    $requestedPlaydates = json_encode($data);
    $upcomingPlaydateQuery = "SELECT dogs.id as id, name as dname, image, date, message FROM `playdates`, dogs WHERE ((dog2=$dogID AND dogs.id = playdates.dog1) OR (dog1 = $dogID AND dogs.id = playdates.dog2)) AND accepted = true ;";
    $result = $GLOBALS['mysqli']->query($upcomingPlaydateQuery);
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    $upcomingPlaydates = json_encode($data);

    echo '{"fname":"'.$fname.'", "dname":"'.$dogName.'", "requestedPlaydates":"'.$requestedPlaydates.'", "upcomingPlaydates":"'.$upcomingPlaydates.'"}';
}catch (Exception $e) {
    echo '{"status":false}';
}