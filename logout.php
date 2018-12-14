<?php
$query = "DELETE FROM sessions WHERE SessionID = ?;";
$stmt = $GLOBALS['mysqli']->prepare($query);
$stmt->bind_param('s', $_COOKIE['SessionID']); //We delete the current user's session from the database
$stmt->execute();
setcookie("SessionID", "", time()-3600); //We delete the cookie SessionID by setting it to an already expired time