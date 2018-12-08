<?php
$dogName = $dataSignup['dname'];
$dogAge = $dataSignup['age'];
$breed = $dataSignup['breed'];
//SQL injection;
if(!checkField($dogName) ||  !checkField($dogAge) || !checkField($breed)){
    $toRet["status"] = "wrong";
    $toRet["field"] = "all";
    $toRet["errorMessage"] = "One of the required fields is empty, probably checked in javascript";
    echo json_encode($toRet);
    return;
}
try{
    $dogInsertQuery = "INSERT INTO `dogs`(`Name`, `Age`, `owner`, `breed`) VALUES ('$dogName',$dogAge,'$username','$breed');";
    $mysqli->query($dogInsertQuery);    
    $toRet["status"] = "ok";
    echo json_encode($toRet);
    return;
}catch (Exception $e) {
    $toRet["status"] = "wrong";
    $toRet["field"] = "all";
    $toRet["errorMessage"] = "Exception received in php".$e.getMessage();
    return;
}
