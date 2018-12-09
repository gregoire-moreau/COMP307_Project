<?php
$username = $dataLogin["uname"];
$hashPass = $dataLogin["password"];

$query = "SELECT * FROM users WHERE username = '$username' AND password = '$hashPass';";

try{
    $result  = $GLOBALS['mysqli']->query($query);
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    if($data == NULL){
     echo '{"status":false}';
    }
    else{
        $success = true;
    }
}catch (Exception $e) {
    echo '{"status":false}';
}
