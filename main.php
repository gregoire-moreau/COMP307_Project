<?php

$fnameQuery = "SELECT firstName as fname, username FROM users WHERE username = (SELECT uname FROM sessions WHERE SessionID = ?);";
$dogIDQuery = "SELECT id FROM dogs WHERE owner = ?";
$stmt =  $GLOBALS['mysqli']->prepare($fnameQuery);
$stmt->bind_param('s', $_COOKIE['SessionID']);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = NULL;
        while($row =  $result->fetch_assoc()){
            $data[] = $row;
        }
        if($data == NULL){
            echo '{"status":false, "fname":"user"}';
            return;
        }
        else{
            $fname = $data[0]["fname"];
            $username = $data[0]["username"];
            $stmt = $GLOBALS['mysqli']->prepare($dogIDQuery);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = NULL;
            while($row =  $result->fetch_assoc()){
                $data[] = $row;
            }
            if($data == NULL){
                echo '{"status":false, "fname":"user"}';
                return;
            }
            $id = $data[0]["id"];
            $numFriendRequestsQuery = "SELECT COUNT(id) FROM friends WHERE dog2 = $id AND accepted = false;";
            $numPlayDateRequestsQuery = "SELECT COUNT(date) FROM playdates WHERE dog2 = $id AND accepted = false";
            $upcomingPlayDatesQuery = "SELECT COUNT(date) FROM playdates WHERE (dog1=$id OR dog2=$id) AND accepted = true";
            $result = $GLOBALS['mysqli']->query($numFriendRequestsQuery);
            $data = NULL;
            while($row =  $result->fetch_assoc()){
                $data[] = $row;
            }
            $numFriendRequests = $data[0]["COUNT(id)"];
            $result = $GLOBALS['mysqli']->query($numPlayDateRequestsQuery);
            $data = NULL;
            while($row =  $result->fetch_assoc()){
                $data[] = $row;
            }
            $numPlayDateRequests = $data[0]["COUNT(date)"];
            $result = $GLOBALS['mysqli']->query($upcomingPlayDatesQuery);
            $data = NULL;
            while($row =  $result->fetch_assoc()){
                $data[] = $row;
            }
            $upcomingPlayDates = $data[0]["COUNT(date)"];

            echo '{"status":true, "fname":"'.$fname.'", "friendsReqNum":'.$numFriendRequests.', "playReqNum":'.$numPlayDateRequests.', "upcomingNum":'.$upcomingPlayDates.'}';
        }