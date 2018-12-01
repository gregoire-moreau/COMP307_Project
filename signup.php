<?php
$username = $_POST['username'];
$email = $_POST['email'];
$hashPass = $_POST['password'];
if(str_word_count($username) >1){ //To avoid sql injection
    echo "error1";
    return;
}
if(strpos($email, " ") >-1){
    echo "error2";
    return;
}
if(str_word_count($hashPass) >1){
    echo "error3";
    return;
}
$uNameQuery = "SELECT COUNT(username) FROM users WHERE username = '$username' ;";
$emailQuery = "SELECT COUNT(email) FROM users WHERE email = '$email' ;";
try{
    $uNameResult  = $mysqli->query($uNameQuery);
    $emailResult  = $mysqli->query($emailQuery);
    while($row =  $uNameResult->fetch_assoc()){
        $dataUname[] = $row;
    }
    if($dataUname[0]["COUNT(username)"] != "0"){
        echo "Username already in use";
    }
    while($row =  $emailResult->fetch_assoc()){
        $dataEmail[] = $row;
    }
    if($dataEmail[0]["COUNT(email)"] != "0"){
        echo "Email already in use";
    }
    //INSERT INTO DATABASE
}catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
}
