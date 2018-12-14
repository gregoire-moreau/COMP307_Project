<?php

$fnameQuery = "SELECT firstName as fname, username FROM users WHERE username = (SELECT uname FROM sessions WHERE SessionID = ?);";
$dogIDQuery = "SELECT id, name FROM dogs WHERE owner = ?";
$stmt =  $GLOBALS['mysqli']->prepare($fnameQuery);
$stmt->bind_param('s', $_COOKIE['SessionID']); //Avoid sql injection by cookie poisoning
$stmt->execute(); //We get the user's first name and username
$result = $stmt->get_result();
$data = NULL;
while($row =  $result->fetch_assoc()){
    $data[] = $row;
}
if($data == NULL){
    echo encrypt('{"status":false, "fname":"user"}');
    return;
}
else{
    $fname = $data[0]["fname"];
    $username = $data[0]["username"];
    $stmt = $GLOBALS['mysqli']->prepare($dogIDQuery);
    $stmt->bind_param('s', $username);
    $stmt->execute(); //We get the user's dog's id for the other queries
    $result = $stmt->get_result();
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    if($data == NULL){
        echo encrypt('{"status":false, "fname":"user"}');
        return;
    }
    $id = $data[0]["id"];
    $dname = $data[0]["name"]; //The dog's name
    $numFriendRequestsQuery = "SELECT COUNT(id) FROM friends WHERE dog2 = $id AND accepted = false;"; //We do queries to get the number of friends requests,
    $numPlayDateRequestsQuery = "SELECT COUNT(date) FROM playdates WHERE dog2 = $id AND accepted = false"; //the number of playdate requests
    $upcomingPlayDatesQuery = "SELECT COUNT(date) FROM playdates WHERE (dog1=$id OR dog2=$id) AND accepted = true"; // and the number of upcoming playdates
    
    //We don't bother using bind_param to avoid sql injection since the only parametre,, id, is created automatically in the database and never set by an user

    $result = $GLOBALS['mysqli']->query($numFriendRequestsQuery);
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    $numFriendRequests = $data[0]["COUNT(id)"];//the number of friends requests

    $result = $GLOBALS['mysqli']->query($numPlayDateRequestsQuery);
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    $numPlayDateRequests = $data[0]["COUNT(date)"];//the number of playdate requests

    $result = $GLOBALS['mysqli']->query($upcomingPlayDatesQuery);
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    $upcomingPlayDates = $data[0]["COUNT(date)"];//the number of upcoming playdates

    echo encrypt('{"status":true, "fname":"'.$fname.'","dname":"'.$dname.'",  "friendsReqNum":'.$numFriendRequests.', "playReqNum":'.$numPlayDateRequests.', "upcomingNum":'.$upcomingPlayDates.'}');
}