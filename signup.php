<?php
$username = $dataSignup['uname'];
$email = $dataSignup['email'];
$hashPass = $dataSignup['password'];
$firstName = $dataSignup['fname'];
$lastName = $dataSignup['lname'];
$location = $dataSignup['location'];


$uNameQuery = "SELECT COUNT(username) FROM users WHERE username = ? ;";
$emailQuery = "SELECT COUNT(email) FROM users WHERE email = ? ;";
try{
    $stmt = $GLOBALS["mysqli"]->prepare($uNameQuery);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $uNameResult  = $stmt->get_result();
    $stmt = $GLOBALS["mysqli"]->prepare($emailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $emailResult  = $stmt->get_result();
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
        $insertQuery = "INSERT INTO `users`(`username`, `email`, `password`, `firstName`, `lastName`, `location`) VALUES (?, ?, ?, ?, ?, ?);";
        $stmt = $GLOBALS["mysqli"]->prepare($insertQuery);
        $stmt->bind_param('ssssss', $username, $email, $hashPass, $firstName, $lastName, $location);
        $stmt->execute();
        $newUser = true;
    }
    
}catch (Exception $e) {
    $toRet["status"] = false;
    $toRet["field"] = "all";
    $toRet["errorMessage"] = "Exception received in php".$e.getMessage();
    return;
}
