<?php
$username = $dataLogin["uname"];
$hashPass = $dataLogin["password"];

$query = "SELECT * FROM users WHERE username = '$username' AND password = '$hashPass';";

try{
    $result  = $mysqli->query($query);
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    if($data == NULL){
     echo '{"status":false}';
    }
    else{
        echo '{"status":true}';
    }
}catch (Exception $e) {
    echo '{"status":false}';
}
