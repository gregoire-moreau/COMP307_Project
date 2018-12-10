<?php
if(isset($_FILES['files'])){
    $errors = [];
    $path = 'uploads/';
    $extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $all_files = count($_FILES['files']['tmp_name']);
    for ($i = 0; $i < $all_files; $i++) {  
        
        $file_tmp = $_FILES['files']['tmp_name'][$i];
        $file_type = $_FILES['files']['type'][$i];
        $file_size = $_FILES['files']['size'][$i];
        $tmp = explode('.', $_FILES['files']['name'][$i]);
        $file_ext = strtolower(end($tmp));
        do{
            $file_name = randomString().'.'.$file_ext;
            $checkQuery = "SELECT * FROM dogs WHERE image= '$file_name'";
            $result = $GLOBALS['mysqli']->query($checkQuery);
            $data = NULL;
            while($row =  $result->fetch_assoc()){
                $data[] = $row;
            }
        }
        while($data !=NULL );
        $file = $path . $file_name;

        if (!in_array($file_ext, $extensions)) {
            $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
        }

        if ($file_size > 20097152) {
            $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
        }

        if (empty($errors)) {
            move_uploaded_file($file_tmp, $file);
            $sqlQuery = "UPDATE dogs SET image = '$file_name' WHERE owner = (SELECT uname FROM sessions WHERE SessionID = '".$_COOKIE['SessionID']."');";
            $GLOBALS['mysqli']->query($sqlQuery);
            echo '{"status":true, "image":"'.$file_name.'"}';
        }
    }

    if ($errors) echo '{"status":false, "error":"'.json_encode($errors).'"}';;
}
