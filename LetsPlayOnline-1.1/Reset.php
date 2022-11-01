<?php 
include_once 'resource/session.php';
include_once 'resource/Database.php';
include_once 'resource/utilities.php';

if(!isset($_SESSION['user_id_reset_pass'])){
    header('location: index.php');
}else{
    $id = $_SESSION['user_id_reset_pass'];
}

//process form if the reset button is clicked
if(isset($_POST['passwordResetBtn'])){

    //initialize array to store errors from the form
    $form_errors = array();

    //form validation
    $required_fields = array('new_password','confirm_password');

    //call function to check empty fields and merge the return data into form_error array
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    //fields that require checking for minimum length
    $fields_to_check_length = array('new_password' => 6, 'confirm_password' => 6);

    //call check minimum length and merge return data into form_error array
    $form_errors = array_merge($form_errors, check_min_lenght($fields_to_check_length));

    //check if error array is empty, if so process form data and insert record
    if(empty($form_errors)){

        //collect form data and store it in variables
       $password1 = $_POST['new_password'];
       $password2 = $_POST['confirm_password'];

        //check if new password and confirm password are the same
        if($password1 != $password2){
            $result = "<p class='regerror'>New password and confirm password do not match</p>";
        }else{
            try{
                //create SQL select statement to verify if user id exists in the database
                $sqlQuery = "SELECT id FROM users WHERE id =:id";

                //use PDO prepare to sanatize data
                $statement = $db->prepare($sqlQuery);

                //execute the query
                $statement->execute(array(':id' => $id));

                //check if record exists
                if($statement->rowCount() == 1){

                    //hash the password
                    $hashed_password = password_hash($password1, PASSWORD_DEFAULT);

                    //SQL statment to update password
                    $sqlUpdate = "UPDATE users SET password =:password WHERE id=:id";

                    //use PDO prepare to sanatize SQL statement
                    $statement = $db->prepare($sqlUpdate);

                    //execute the statement
                    $statement->execute(array(':password' => $hashed_password, 'id' => $id));

                    //Remove token entry from password_reset_request
                    //remove row where $id/:id is user_id
                    $sqlDelete = "DELETE FROM password_reset_request WHERE user_id = :user_id";
                    $statement = $db->prepare($sqlDelete);
                    $statement->execute(array(':user_id' => $id));

                    $result = "<p class='regsuccess'>Password Reset Successful</p>";
                }else{
                    $result = "<p class='regerror'>The email provided does not exist in the database, please try again.</p>";
                }

            }catch(PDOException $ex){
                $result = "<p class='regerror'>An error occurred: " . $ex->getMessage() . "</p>";
            }
        }

    }else{
        if(count($form_errors)==1){
            $result = "<p class='error'>There was one error in the form <br>";
        }else{
            $result = "<p class='error'>There were " . count($form_errors) . " errors in the form<br>";
        }
    }
}



?>

<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://kit.fontawesome.com/5b145bfb33.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="LetsPlay.css">

    <link rel="stylesheet" href="style/style.css">

    <title>Lets Play</title>

</head>
<body>
    
<?php 
    include_once 'resource/navbar.php';
?>


<div class="container">
    <h1 class="text-center display-4">Lets Play Password Reset</h1>

    <?php 
        if(isset($result)){
            echo $result;
        }
        if(!empty($form_errors)){
            echo show_errors($form_errors);
        }
    ?>
</div>



<div class="container">
    <form method="POST" action="">
        <div class="form-group">
        <label for="exampleInputPassword1">New Password</label>
        <input type="password" name="new_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
        <label for="exampleInputPassword1">Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" name="passwordResetBtn"  class="btn btn-primary">Submit</button>
    </form>

</div>



<?php 
    include_once 'resource/JSIncludes.php';
?> 
</body>
</html>