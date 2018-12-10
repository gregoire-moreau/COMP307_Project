<?php
$dogIDQuery = "SELECT id, location from dogs, users WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?) AND username = (SELECT uname FROM sessions WHERE SessionID = ?) ;";
try{
    $stmt  = $GLOBALS['mysqli']->prepare($dogIDQuery);
    $stmt->bind_param('ss', $_COOKIE["SessionID"], $_COOKIE["SessionID"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    if($data == NULL){
     echo '{"status":false}';
     return;
    }
    else{
        $dogID = $data[0]["id"];
        $location = $data[0]["location"];
        $friendsQuery = "SELECT id, Name as dname, breed, age, activity1 as act1, activity2 as act2, activity3 as act3, image FROM dogs WHERE id in (SELECT dog2 FROM friends WHERE dog1 = $dogID AND accepted=true) OR id in (SELECT dog1 FROM friends WHERE dog2 = $dogID AND accepted=true)";
        $result = $GLOBALS['mysqli']->query($friendsQuery);
        $data = NULL;
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        $friends = json_encode($data);
        $pendingRequestsQuery = "SELECT id, Name as dname, breed, age, activity1 as act1, activity2 as act2, activity3 as act3, image FROM dogs WHERE id in (SELECT dog1 FROM friends WHERE dog2 = $dogID AND accepted=false)";
        $result = $GLOBALS['mysqli']->query($pendingRequestsQuery);
        $data = NULL;
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        $requests = json_encode($data);
        $otherDogsQuery = "SELECT id, Name as dname, breed, age, activity1 as act1, activity2 as act2, activity3 as act3, image FROM dogs WHERE owner in (SELECT username FROM users where location = '$location') AND id NOT IN (SELECT dog1 FROM friends WHERE dog2=$dogID) AND id NOT IN (SELECT dog2 FROM friends where dog1=$dogID);";
        $result = $GLOBALS['mysqli']->query($otherDogsQuery);
        $data = NULL;
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        $otherDogs = json_encode($data);
        echo '{"status":true, "friends":'.$friends.', "pendingRequests":'.$requests.', "otherDogs":'.$otherDogs.'}';
    }

    
}catch (Exception $e) {
    echo '{"status":false}';
}