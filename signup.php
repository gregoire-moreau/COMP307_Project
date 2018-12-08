<?php
$username = $_POST['uname'];
$email = $_POST['email'];
$hashPass = $_POST['password'];
$firstName = $_POST['fname'];
$lastName = $_POST['lname'];
$location = $_POST['location'];
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
if(!checkField($username) ||  !checkField($email) || !checkField($hashPass)){
    echo "One of the required fields for the user is empty";
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
        return;
    }
    while($row =  $emailResult->fetch_assoc()){
        $dataEmail[] = $row;
    }
    if($dataEmail[0]["COUNT(email)"] != "0"){
        echo "Email already in use";
    }
    else{
        $insertQuery = "INSERT INTO `users`(`username`, `email`, `password`, `firstName`, `lastName`, `location`) VALUES ('$username', '$email', '$hashPass', '$firstName', '$lastName', '$location');";
        $mysqli->query($insertQuery);
        $newUser = true;
        //INSERT INTO DATABASE
        echo "ok";
    }
    
}catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
}
