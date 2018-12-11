<?php
$checkQuery = "SELECT accepted FROM playdates WHERE dog2 = (SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?)) AND dog1=?;";
$stmt =  $GLOBALS['mysqli']->prepare($checkQuery);
$stmt->bind_param('sd',$_COOKIE['SessionID'], $dogData["dogID"] );
$stmt->execute();
$result = $stmt->get_result();
$data = NULL;
while($row =  $result->fetch_assoc()){
    $data[] = $row;
}
if ($dogData["answer"] == "true"){
    if($data == NULL || $data[0]["accepted"]){
        echo '{"status":false}';
        return;
    }
    $query = "UPDATE playdates SET accepted = true WHERE dog2 = (SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?)) AND dog1=?;";
}else{
    if($data == NULL || $data[0]["accepted"]){
        echo '{"status":false}';
        return;
    }
    $query = "DELETE FROM playdates WHERE dog2 = (SELECT id FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?)) AND dog1=?;";
}
$stmt =  $GLOBALS['mysqli']->prepare($query);
$stmt->bind_param('sd',$_COOKIE['SessionID'], $dogData["dogID"] );
$stmt->execute();
echo '{"status":true}';