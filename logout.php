<?php
echo "jodpz";
$query = "DELETE FROM sessions WHERE SessionID = '".$_COOKIE['SessionID']."';";
echo $query;
try{
    $GLOBALS['mysqli']->query($query);
    setcookie("SessionID", "", time()-3600);
}catch (Exception $e) {
    echo 'Something bad happened;
}
