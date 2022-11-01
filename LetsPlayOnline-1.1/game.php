<?php
include_once 'resource/session.php';
include_once 'resource/Database.php';
include_once 'resource/utilities.php';


$id = $_GET['id'];
$user = $_SESSION['username'];

//for the sake of edit code
$_SESSION['id'] = $id;

$query = "SELECT * FROM games WHERE id = '$id' and owner = :username";

$statement = $db->prepare($query);

$statement->execute(array(':username' => $user));

$row = $statement->fetch();

$name = $row["Name"];
$players = $row["Players"];
$owner = $row['Owner'];
$description = $row['description'];
$file = $row['filename'];

//for deleting the old file if a new one is uploaded
$_SESSION['filename'] = $file;

//
if(!isset($_SESSION['username'])){
    header('location: index.php');
}else if(! $user == $owner){
    header('location: index.php');
}

//the update code
if(isset($_POST['editbtn'])){

    //colect form text data and store in variables
    $newname = $_POST['name'];
    $newplayers = $_POST['players'];
    $newdescription = $_POST['description'];
    $id = $_SESSION['id'];
    $owner = $_SESSION['username']; //yea, owner would never have to be changed, but required for right image folder

    //for deleting the old file
    $filetoDelete = $_SESSION['filename'];

    //initialize an array to store any error messages from the form
    $form_errors = array();

    //form validation/ remove
    $required_fields = array('name','players');

    //call the function to check empty fields and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    //Fields that require checking for minimum lenght/remove
    $fields_to_check_lenght = array('name' => 1);

    //call the function to check the minimum lenght and merge the return data into the form_error array
    $form_errors = array_merge($form_errors, check_min_lenght($fields_to_check_lenght));

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

        //check if filesize is over 4mb, use smaller size for testing 4194304 bytes
        if($file_size > 4194304){
            //put into array
            echo "<br>File too large";
            $file_errors = 1;
        }

        //check for valid extentions
        //jpg|\.jpeg|\.bmp|\.gif|\.png
        // Allow certain file formats 
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

        //how can I check if the file already exists?
        //which was the entire filepath again? $uploadfile I think
        if (file_exists($uploadfile)) {
            echo "<br>The file file already exists";
            $file_errors = 1;
        }

    }

   //initialize image errors array...is this still needed?
    $I = 0;
    $image_errors = array();

    //Edit db if $form_errors is empty
    if(empty($form_errors)){

        //update the name, if a new one was given
        //a new name is still mandatory but maybe I'll change that later
        if($newname!=""){

            $sqlEdit = "UPDATE games SET Name = :Name WHERE id = :id";

            //use PDO prepare to sanitize data
            $statement = $db->prepare($sqlEdit);

            //execute the statement
            $statement->execute(array(':Name' => $newname, 'id' => $id));

        }

        if($newplayers!=""){

            $sqlEdit = "UPDATE games SET Players = :Players WHERE id = :id";

            //use PDO prepare to sanitize data
            $statement = $db->prepare($sqlEdit);
        
            //execute the statement
            $statement->execute(array(':Players' => $newplayers, 'id' => $id));

        }
        
        //
        if($newdescription != ""){
            
            $sqlEdit = "UPDATE games SET description = :description WHERE id = :id";
            
            //use PDO prepare to sanitize data
            $statement = $db->prepare($sqlEdit);
            
            //ececute the statement
            $statement->execute(array(':description' => $newdescription, 'id' => $id));
            
        }

        //also change the filename in the database
        if($file_name!=""){

            $sqlEdit = "UPDATE games SET filename = :filename WHERE id = :id";

            //use PDO prepare to sanatize data
            $statement = $db->prepare($sqlEdit);

            //execute the statment
            $statement->execute(array(':filename' => $file_name, 'id' => $id));

        }

        //upload file if file errors is zero
        if($file_errors==0){

            //replace the image if there is one
            //"uploads . $owner . $file; if old file is not empty inside the upload if for the new file
            if($file!=""){
                $toDelete = 'uploads/' . $owner . '/' . $filetoDelete;
                unlink($toDelete);
            }

            //the echos are usless here since this page refreshes itself
            if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadfile)) {
                echo "<br>File is valid, and was successfully uploaded.<br>";
            } else {
                echo "<br>NOT UPLOADED!";
            }

        }

        //refresh page after successful edit
        header("Refresh:0");

    }

}

//the update code
if(isset($_POST['deletebtn'])){

    //echo '<script language="javascript">alert("Got into delete.");</script>';
    $id = $_SESSION['id'];

    $sqlDelete = "DELETE FROM games WHERE id = :id";

    //use PDO prepare to sanatize data
    $statement = $db->prepare($sqlDelete);

    //execute the statment
    $statement->execute(array('id' => $id));

    header('location: index.php');
}


?>
<html>
<head>
            <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://kit.fontawesome.com/5b145bfb33.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="LetsPlay.css">

    <link rel="stylesheet" href="style/searchStyle.css">

    <link rel="stylesheet" href="style/style.css">

    <title>Lets Play</title>

</head>
<body>

<?php 
    include_once 'resource/navbar.php';
?>


<div style="padding: 10px 20px;" class="container">

    <?php

        echo "<h4>Name: $name</h4>";

        echo "<h4>Players: $players</h4>";
        
        if($description != ""){
            echo "<pre>$description</pre>";
        }

        if($file != ""){
            include_once 'resource/gameimage.php';
        }

    ?>

    <form method="post" action="">
        <button name="Edit">Edit entry</button>
    </form>

</div>

<?php
    if(!empty($form_errors)){
        echo show_errors($form_errors);
    }

?>

<?php
    if(isset($_POST['Edit'])){
        include_once 'resource/editform.php';
    }
?>


<script type="text/javascript" src="resource/scripts.js"></script>
<?php 
    include_once 'resource/JSIncludes.php';
?> 
</body>
</html>