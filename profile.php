<?php
$sqlQuery = "SELECT firstName as fname, Name as dname, breed, age, activity1 as act1, activity2 as act2, activity3 as act3, image FROM users, dogs WHERE users.username = (SELECT uname from sessions where SessionID = ?) AND dogs.owner = (SELECT uname from sessions where SessionID = ?);";
try{
    $stmt  = $GLOBALS['mysqli']->prepare($sqlQuery);
    $stmt->bind_param('ss', $_COOKIE['SessionID'], $_COOKIE['SessionID']);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    if($data == NULL){
     return $response;
    }
    else{
        echo json_encode($data[0]);
    }
}catch (Exception $e) {
    echo '{"status":false}';
}