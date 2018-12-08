<?php
$dogName = $_POST['dname'];
$dogAge = $_POST['age'];
$breed = $_POST['breed'];
//SQL injection;
if(!checkField($dogName) ||  !checkField($dogAge) || !checkField($breed)){
    echo "one of the required fields is empty";
    return;
}
try{
    $dogInsertQuery = "INSERT INTO `dogs`(`Name`, `Age`, `owner`, `breed`) VALUES ('$dogName',$dogAge,'$username','$breed');";
    echo $dogInsertQuery;
    $mysqli->query($dogInsertQuery);    
}catch (Exception $e) {
    echo 'Exception reçue : ',  $e->getMessage(), "\n";
}
