<?php
$dogName = $dataSignup['dname'];
$dogAge = $dataSignup['age'];
$breed = $dataSignup['breed'];
$act1 = $dataSignup['act1'];
$act2 = $dataSignup['act2'];
$act3 = $dataSignup['act3'];
try{
    $dogInsertQuery = "INSERT INTO `dogs`(`Name`, `Age`, `owner`, `breed`, activity1, activity2, activity3) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stmt = $GLOBALS["mysqli"]->prepare($dogInsertQuery);
    $stmt->bind_param('sdsssss', $dogName, $dogAge, $username, $breed, $act1, $act2, $act3);
    $stmt->execute();    
    $toRet["status"] = true;
    echo json_encode($toRet);
    return;
}catch (Exception $e) {
    $toRet["status"] = false;
    $toRet["field"] = "all";
    $toRet["errorMessage"] = "Exception received in php".$e.getMessage();
    return;
}
