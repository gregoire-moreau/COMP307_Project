<?php
$username = $dataLogin["uname"];
$hashPass = $dataLogin["password"];

$query = "SELECT * FROM users WHERE username = ? AND password = ?;";

try{
    $stmt = $GLOBALS['mysqli']->prepare($query);
    $stmt->bind_param('ss', $username, $hashPass);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = NULL;
    while($row =  $result->fetch_assoc()){
        $data[] = $row;
    }
    if($data == NULL){
     echo '{"status":false}';
    }
    else{
        $success = true;
    }
}catch (Exception $e) {
    echo '{"status":false}';
}
