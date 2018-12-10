<?php
if(isset($_FILES['files'])){
    echo "lol";
    $errors = [];
    $path = 'uploads/';
    $extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $all_files = count($_FILES['files']['tmp_name']);
    for ($i = 0; $i < $all_files; $i++) {  
        
        $file_tmp = $_FILES['files']['tmp_name'][$i];
        $file_type = $_FILES['files']['type'][$i];
        $file_size = $_FILES['files']['size'][$i];
        $file_ext = strtolower(end(explode('.', $_FILES['files']['name'][$i])));
        $file_name = randomString().'.'.$file_ext;
        $file = $path . $file_name;

        if (!in_array($file_ext, $extensions)) {
            $errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
        }

        if (empty($errors)) {
            move_uploaded_file($file_tmp, $file);
            $sqlQuery = "UPDATE dogs SET image = '$file_name' WHERE owner = (SELECT uname FROM sessions WHERE SessionID = '".$_COOKIE['SessionID']."');";
            $GLOBALS['mysqli']->query($sqlQuery);
            echo '{"status":true}';
        }
    }

    if ($errors) echo '{"status":false}';;
}
