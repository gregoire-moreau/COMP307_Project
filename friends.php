<?php
$dogIDQuery = "SELECT id, name, firstName from dogs, users WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?) AND username = (SELECT uname FROM sessions WHERE SessionID = ?) ;";
try{
    
    $stmt  = $GLOBALS['mysqli']->prepare($dogIDQuery);
    $stmt->bind_param('ss', $_COOKIE["SessionID"],$_COOKIE["SessionID"]);
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
        $firstName =  $data[0]["firstName"];
        $dogName = $data[0]["name"];
        $friendsQuery = "SELECT id, Name as dname, breed, age, activity1 as act1, activity2 as act2, activity3 as act3, image FROM dogs WHERE id in (SELECT dog2 FROM friends WHERE dog1 = $dogID AND accepted=true) OR id in (SELECT dog1 FROM friends WHERE dog2 = $dogID AND accepted=true)";
        $result = $GLOBALS['mysqli']->query($friendsQuery);
        $data = NULL;
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        $friends = json_encode($data);
        echo '{"status":true, "fname":"'.$firstName.'", "dname":"'.$dogName.'" ,  "friends":'.$friends.'}';
    }

    
}catch (Exception $e) {
    echo '{"status":false}';
}