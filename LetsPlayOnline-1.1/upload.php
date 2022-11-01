<?php
include_once 'resource/session.php';
include_once 'resource/Database.php';
include_once 'resource/utilities.php';


if(!isset($_SESSION['username'])){
    header('location: index.php');
}


    //redirect links back to insert and index
    echo "<br><a href='insertGame.php'>Back to insert</a><br>";
    echo "<br><a href='index.php'>Back to Index</a>";


    //colect form text data and store in variables
    $name = $_POST['name'];
    $description = $_POST['description'];
    //Players
    $players = $_POST['players'];
    $owner = $_SESSION['username'];


    //initialize an array to store any error messages from the form
    $form_errors = array();

    //form validation
    //also players?
    $required_fields = array('name');


    //call the function to check empty fields and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    //Fields that require checking for minimum lenght
    $fields_to_check_lenght = array('name' => 1);

    //call the function to check the minimum lenght and merge the return data into the form_error array
    $form_errors = array_merge($form_errors, check_min_lenght($fields_to_check_lenght));


    //show form text errors
    if(!empty($form_errors)){
        echo show_errors($form_errors);
    }

    //file variables
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];

    $fileToUpload = $_FILES['fileToUpload']['name'];

    //change to personal folder
    $uploaddir = "uploads/$owner/";
    $uploadfile = $uploaddir . basename($_FILES['fileToUpload']['name']);
    $file_errors = 1;

    //only do the following if file is not empty
    if($file_name != ""){

        $file_errors = 0;

        if($file_size > 4194304){
            echo "<br>File too large";
            $file_errors = 1;
        }

        if(substr($file_type, -4)=="jpeg"){
            $file_ex = substr($file_type, -4);
        }else{
            $file_ex = substr($file_type, -3);
        }

        if($file_ex != "jpg" && $file_ex != "png" && $file_ex != "jpeg"
            && $file_ex != "gif" ) {
            echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $file_errors = 1;
        }

        if (file_exists($uploadfile)) {
            echo "<br>The file file already exists";
            $file_errors = 1;
        }

    }

    //are these actually used?
    $I = 0;
    $image_errors = array();


    //insert into db if $form_errors is empty
    if(empty($form_errors)){

        //create sql insert statement
        //adjust
        $sqlInsert = "INSERT INTO games (Name, Players, description, filename, owner)
        VALUES (:Name, :Players, :description, :filename, :owner)";

        //use PDO prepare to sanitize data
        $statement = $db->prepare($sqlInsert);

        //replace $fileToUpload with $uploadfile?
        $statement->execute(array(':Name' => $name, ':Players' => $players, ':description' => $description,  
        ':filename' => $fileToUpload, 'owner' => $owner));

        echo "<br><h3>Insert success!</h3>";

        //upload file if file errors is zero
        if($file_errors==0){

            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadfile)) {
                echo "<br>File is valid, and was successfully uploaded.<br>";
            } else {
                echo "<br>NOT UPLOADED!";
            }

        }

    }


?>