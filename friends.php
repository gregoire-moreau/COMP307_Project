<?php
$dogIDQuery = "SELECT id from dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?) ;";
try{
    $stmt  = $GLOBALS['mysqli']->prepare($dogIDQuery);
    $stmt->bind_param('s', $_COOKIE["SessionID"]);
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
        $friendsQuery = "SELECT id, Name as dname, breed, age, activity1 as act1, activity2 as act2, activity3 as act3, image FROM dogs WHERE id in (SELECT dog2 FROM friends WHERE dog1 = $dogID AND accepted=true) OR id in (SELECT dog1 FROM friends WHERE dog2 = $dogID AND accepted=true)";
        $result = $GLOBALS['mysqli']->query($friendsQuery);
        $data = NULL;
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        $friends = json_encode($data);
        echo '{"status":true, "friends":'.$friends.'}';
    }

    
}catch (Exception $e) {
    echo '{"status":false}';
}