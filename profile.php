<?php
$sqlQuery = "SELECT firstName as fname, Name as dname, breed, age, activity1 as act1, activity2 as act2, activity3 as act3, image FROM users, dogs WHERE users.username = (SELECT uname from sessions where SessionID = ?) AND dogs.owner = (SELECT uname from sessions where SessionID = ?);";
try{
    $stmt  = $GLOBALS['mysqli']->prepare($sqlQuery);
    $stmt->bind_param('ss', $_COOKIE['SessionID'], $_COOKIE['SessionID']); //Avoid sql injection by cookie poisoning
    $stmt->execute();
    $result = $stmt->get_result(); //We get data about the user and his dog that we want to display on the profile page
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    if($data == NULL){
     return $response;
    }
    else{
        echo encrypt(json_encode($data[0])); //We return the data to the browser
    }
}catch (Exception $e) {
    echo encrypt('{"status":false}');
}