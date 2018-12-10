<?php
$dogIDQuery = "SELECT id from dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?);";
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
        $pendingRequestsQuery = "SELECT id, Name as dname, breed, age, activity1 as act1, activity2 as act2, activity3 as act3, image FROM dogs WHERE id in (SELECT dog1 FROM friends WHERE dog2 = $dogID AND accepted=false)";
        $result = $GLOBALS['mysqli']->query($pendingRequestsQuery);
        $data = NULL;
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        if($data == NULL){
         echo '{"status":false}';
         return;
        }
        $requests = json_encode($data);
        echo '{"status":true, "friends":'.$requests.'}';
    }

    
}catch (Exception $e) {
    echo '{"status":false}';
}