<?php
$dogIDQuery = "SELECT id, name, firstName from dogs, users WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?) AND username = (SELECT uname FROM sessions WHERE SessionID = ?) ;";
try{
    $stmt  = $GLOBALS['mysqli']->prepare($dogIDQuery); //First we get the current user's first name aswell as his dog's id and name
    $stmt->bind_param('ss', $_COOKIE["SessionID"],$_COOKIE["SessionID"]);  //Avoid sql injection by cookie poisoning
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
        $dogID = $data[0]["id"];
        $firstName =  $data[0]["firstName"];
        $dogName = $data[0]["name"];
        $friendsQuery = "SELECT id, Name as dname, breed, age, activity1 as act1, activity2 as act2, activity3 as act3, image FROM dogs WHERE id in (SELECT dog2 FROM friends WHERE dog1 = $dogID AND accepted=true) OR id in (SELECT dog1 FROM friends WHERE dog2 = $dogID AND accepted=true)";
        $result = $GLOBALS['mysqli']->query($friendsQuery); //We don't bother checking for sql injection as the only parametre here is the dog's id which is created automatically and never returned to the user
        $data = NULL;
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }

        $friends = json_encode($data);
        echo encrypt('{"status":true, "fname":"'.$firstName.'", "dname":"'.$dogName.'" ,  "friends":'.$friends.'}');//We return info about the dog's friends to the browser
    }

    
}catch (Exception $e) {
    echo encrypt('{"status":false}');
}