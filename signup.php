<?php
$username = $dataSignup['uname'];
$email = $dataSignup['email'];
$hashPass = $dataSignup['password'];
$firstName = $dataSignup['fname'];
$lastName = $dataSignup['lname'];
$location = $dataSignup['location'];

$uNameQuery = "SELECT COUNT(username) FROM users WHERE username = '$username' ;";
$emailQuery = "SELECT COUNT(email) FROM users WHERE email = '$email' ;";
try{
    $uNameResult  = $GLOBALS["mysqli"]->query($uNameQuery);
    $emailResult  = $GLOBALS["mysqli"]->query($emailQuery);
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
        $GLOBALS["mysqli"]->query($insertQuery);
        $newUser = true;
    }
    
}catch (Exception $e) {
    $toRet["status"] = false;
    $toRet["field"] = "all";
    $toRet["errorMessage"] = "Exception received in php".$e.getMessage();
    return;
}
