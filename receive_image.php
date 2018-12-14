<?php
if(isset($_FILES['files'])){ //We check if there is an image with the requests
    $errors = [];
    $path = 'uploads/';
    $extensions = ['jpg', 'jpeg', 'png', 'gif']; //The accepted extensions
    $all_files = count($_FILES['files']['tmp_name']);
    for ($i = 0; $i < $all_files; $i++) {  
        
        $file_tmp = $_FILES['files']['tmp_name'][$i];
        $file_type = $_FILES['files']['type'][$i];
        $file_size = $_FILES['files']['size'][$i];
        $tmp = explode('.', $_FILES['files']['name'][$i]);
        $file_ext = strtolower(end($tmp));
        do{
            $file_name = randomString().'.'.$file_ext; //We create a random name for the new image
            $checkQuery = "SELECT * FROM dogs WHERE image= '$file_name'";
            $result = $GLOBALS['mysqli']->query($checkQuery);
            $data = NULL;
            while($row =  $result->fetch_assoc()){
                $data[] = $row;
            }
        }
        while($data !=NULL ); //If there is already an image with that name
        $file = $path . $file_name;

        if (!in_array($file_ext, $extensions)) { //If the extension is not accepted
            $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
        }

        if ($file_size > 5242880) { //If the file size is > 5MB
            $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
        }

        if (empty($errors)) {
            move_uploaded_file($file_tmp, $file); //We move the new image to the uploads folder
            $checkQuery = "SELECT image FROM dogs WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?);";
            $stmt =  $GLOBALS['mysqli']->prepare($checkQuery);
            $stmt->bind_param('s', $_COOKIE['SessionID']); //Avoid sql injection
            $stmt->execute();
            $result = $stmt->get_result(); //We get the former image associated with the dog
            $data = NULL;
            while($row =  $result->fetch_assoc()){
                $data[] = $row;
            }
            $oldImage = $data[0]["image"];
            if($oldImage != "dog.png"){ //If it wasn't dog.png, the default image
                unlink($path.$oldImage); //We delete the former image
            }
            $sqlQuery = "UPDATE dogs SET image = '$file_name' WHERE owner = (SELECT uname FROM sessions WHERE SessionID = ?);";
            $stmt =  $GLOBALS['mysqli']->prepare($sqlQuery);
            $stmt->bind_param('s', $_COOKIE['SessionID']);
            $stmt->execute(); //We add the new image path to the database for the user's dog
            echo encrypt('{"status":true, "image":"'.$file_name.'"}');//We return the new image path to the browser so that it can display it 
        }
    }

    if ($errors) echo encrypt('{"status":false, "error":"'.json_encode($errors).'"}');
}
