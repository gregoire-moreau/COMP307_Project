<?php
$username = "Aeroceli";
$sqlQuery = "SELECT * FROM dogs WHERE id in (SELECT dog1 FROM friends where dog2 IN (SELECT id From dogs where owner = '$username') AND accepted = false); ";
try{
    $result  = $GLOBALS['mysqli']->query($sqlQuery);
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    if($data == NULL){
     echo '{"status":false}';
    }
    else{
        $requests = json_encode($data);
        echo '{"status":true, "requests":'.$requests.'}';
    }
}catch (Exception $e) {
    echo '{"status":false}';
}