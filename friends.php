<?php
$username = "Aeroceli";
$sqlQuery = "SELECT * FROM dogs WHERE id in (SELECT dog1 FROM friends where dog2 IN (SELECT id From dogs where owner = '$username') AND accepted = true) OR id in  (SELECT dog2 FROM friends where dog1 IN (SELECT id From dogs where owner = '$username') AND accepted = true); ";
try{
    $result  = $mysqli->query($sqlQuery);
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    if($data == NULL){
     echo '{"status":false}';
    }
    else{
        $friends = json_encode($data);
        echo '{"status":true, "requests":'.$friends.'}';
    }
}catch (Exception $e) {
    echo '{"status":false}';
}