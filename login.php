<?php
$username = $dataLogin["uname"];
$hashPass = $dataLogin["password"];

if(str_word_count($username) >1){ //To avoid sql injection
    echo "error1";
    return;
}
if(strpos($hashPass, " ") >-1){
    echo "error3";
    return;
}
$query = "SELECT * FROM users WHERE username = '$username' AND password = '$hashPass';";

try{
    $result  = $mysqli->query($query);
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    if($data == NULL){
     echo '{"status":"wrong"}';
    }
    else{
        echo '{"status":"ok"}';
    }
}catch (Exception $e) {
    echo '{"status":"wrong"}';
}
