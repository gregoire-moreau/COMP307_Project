<?php
$username = $dataLogin["uname"];
$hashPass = $dataLogin["password"];

$query = "SELECT * FROM users WHERE username = ? AND password = ?;"; //We check if there is a user with that username and password

try{
    $stmt = $GLOBALS['mysqli']->prepare($query);
    $stmt->bind_param('ss', $username, $hashPass); //Avoid sql injection
    $stmt->execute();
    $result = $stmt->get_result();
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    if($data == NULL){
     echo encrypt('{"status":false}'); //There is no user with that username/password combination, so login fails
    }
    else{
        $success = true; //Login succeeded, we create a sessionID for the user in index.php
    }
}catch (Exception $e) {
    echo encrypt('{"status":false}');
}
