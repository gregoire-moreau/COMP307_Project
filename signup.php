<?php
$username = $dataSignup['uname'];
$email = $dataSignup['email'];
$hashPass = $dataSignup['password'];
$firstName = $dataSignup['fname'];
$lastName = $dataSignup['lname'];
$location = $dataSignup['location'];

if(strpos($username, " ") >-1){ //To avoid sql injection
    $toRet["status"] = false;
    $toRet["field"] = "uname";
    $toRet["errorMessage"] = "Username should be in one word";
    echo json_encode($toRet);
    return;
}
if(strpos($email, " ") >-1){
    $toRet["status"] = false;
    $toRet["field"] = "email";
    $toRet["errorMessage"] = "Email shouldn't contain spaces";
    echo json_encode($toRet);
    return;
}
if(str_word_count($hashPass) >1){
    $toRet["status"] = false;
    $toRet["field"] = "password";
    $toRet["errorMessage"] = "Password shouldn't contain spaces";
    echo json_encode($toRet);
    return;
}
if(!checkField($username) ||  !checkField($email) || !checkField($hashPass)){
    $toRet["status"] = false;
    $toRet["field"] = "all";
    $toRet["errorMessage"] = "One of the required fields is empty, probably checked in javascript";
    echo json_encode($toRet);
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
        $toRet["status"] = false;
        $toRet["field"] = "username";
        $toRet["errorMessage"] = "This username is already taken.";
        echo json_encode($toRet);
        return;
    }
    while($row =  $emailResult->fetch_assoc()){
        $dataEmail[] = $row;
    }
    if($dataEmail[0]["COUNT(email)"] != "0"){
        $toRet["status"] = false;
        $toRet["field"] = "email";
        $toRet["errorMessage"] = "This email is already taken.";
        echo json_encode($toRet);
        return;
    }
    else{
        $insertQuery = "INSERT INTO `users`(`username`, `email`, `password`, `firstName`, `lastName`, `location`) VALUES ('$username', '$email', '$hashPass', '$firstName', '$lastName', '$location');";
        $mysqli->query($insertQuery);
        $newUser = true;
    }
    
}catch (Exception $e) {
    $toRet["status"] = false;
    $toRet["field"] = "all";
    $toRet["errorMessage"] = "Exception received in php".$e.getMessage();
    return;
}
