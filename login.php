<?php
$username = $_POST['username'];
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
        echo "There is no user with that username or the password doesn't match the username";
    }
    echo var_dump($data);
}catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
}