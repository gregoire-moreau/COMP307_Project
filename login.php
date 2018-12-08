<?php
$username = $_POST['uname'];
$hashPass = $_POST['password'];
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
       return $response->withStatus(201);
    }
    else{
        return $response->withStatus(200);
    }
}catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
}