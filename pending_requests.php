<?php
$dogIDQuery = "SELECT id, name, activity1, activity2, activity3, firstName, location from dogs, users WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?) AND username = (SELECT uname FROM sessions WHERE SessionID = ?) ;";
try{
    $stmt  = $GLOBALS['mysqli']->prepare($dogIDQuery);
    $stmt->bind_param('ss', $_COOKIE["SessionID"], $_COOKIE["SessionID"]); //Avoid sql injection
    $stmt->execute();
    $result = $stmt->get_result();
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    if($data == NULL){
     echo encrypt('{"status":false}');
     return;
    }
    else{
        //We get info about the dog and the user
        $dogID = $data[0]["id"];
        $location = $data[0]["location"];
        $fname =  $data[0]["firstName"];
        $dogName =  $data[0]["name"];
        $act1 =  $data[0]["activity1"];
        $act2 =  $data[0]["activity2"];
        $act3 =  $data[0]["activity3"];

        $pendingRequestsQuery = "SELECT id, Name as dname, breed, age, activity1 as act1, activity2 as act2, activity3 as act3, image FROM dogs WHERE id in (SELECT dog1 FROM friends WHERE dog2 = $dogID AND accepted=false)";
        $result = $GLOBALS['mysqli']->query($pendingRequestsQuery); //We get all the pending friend requests for the user's dog
        $data = NULL;
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        $requests = json_encode($data);

        $otherDogsQuery = "SELECT id, Name as dname, breed, age, activity1 as act1, activity2 as act2, activity3 as act3, image FROM dogs WHERE id!= $dogID AND owner in (SELECT username FROM users where location = '$location') AND id NOT IN (SELECT dog1 FROM friends WHERE dog2=$dogID) AND id NOT IN (SELECT dog2 FROM friends where dog1=$dogID);";
        $result = $GLOBALS['mysqli']->query($otherDogsQuery); //We get all the dogs in the same location as the user who currently have no relation with the dog
        $data = NULL;
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        $otherDogs = json_encode($data);
        echo encrypt('{"status":true, "fname":"'.$fname.'", "dname":"'.$dogName.'" , "act1":"'.$act1.'", "act2":"'.$act2.'","act3":"'.$act3.'", "pendingRequests":'.$requests.', "otherDogs":'.$otherDogs.'}');
    }

    
}catch (Exception $e) {
    echo '{"status":false}';
}