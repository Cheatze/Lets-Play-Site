<?php
//Add database conection script
include_once 'resource/session.php';
include_once 'resource/Database.php';
include_once 'resource/utilities.php';


if(isset($_POST['loginBtn'])){

    //array to hold errors
    $form_errors = array();

    //validate
    $required_fields = array('username', 'password');
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));

    if(empty($form_errors)){

        //collect form data
        $user = $_POST['username'];
        $password = $_POST['password'];

        //check if user exists in the database
        $sqlQuery = "SELECT * FROM users WHERE username = :username";

        $statement = $db->prepare($sqlQuery);
        $statement->execute(array(':username' => $user));

        if($row = $statement->fetch()){
            $id = $row['id'];
            $hashed_password = $row['password'];
            $username = $row['username'];
    
            if(password_verify($password, $hashed_password)){
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $username;
                header("location: index.php");
            }else{
                $result = "<p class='regerror'>Invalid username or password<p>";
            }
        }else{
            $result = "<p class='regerror'>Invalid username or password<p>";
        }

    }else{
        if(count($form_errors)==1){
            $result = "<p class='error'>There was one error in the form </p>";
        }else{
            $result = "<p class='error'>There were " . count($form_errors) . " errors in the form </p>";
        }
    }

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

    <link rel="stylesheet" href="style/LetsPlay.css">
    <link rel="stylesheet" type="text/css" href="style/style.css"></link>

    <title>Lets Play</title>
</head>
<body>
    
    <?php 
        include_once 'resource/navbar.php';
    ?>

    <div class="container">
        <?php 
            if(isset($result)) echo $result; 
            if(!empty($form_errors)) echo show_errors($form_errors);
        ?>
    </div>


    <div class="container">
        <form method="post" action="">
            <div class="form-group ml-20px">
            <label>Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter username">
            </div>
            <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group form-check">
            </div>
            <button type="submit" name="loginBtn" class="btn btn-primary">Submit</button>
        </form>
    </div>


    <div class="container FWP">
        <p>Forgot password?</p>
        <a href="request.php">Change password</a>
    </div>


    <?php 
        include_once 'resource/JSIncludes.php';
    ?> 
</body>
</html>