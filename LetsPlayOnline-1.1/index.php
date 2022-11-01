<?php
include_once 'resource/session.php';
//echo 'PHP version: ' . phpversion();
?>

<html>
<head lang="en">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://kit.fontawesome.com/5b145bfb33.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style/LetsPlay.css">

<title>Lets Play</title>
</head>
<body>

    
    <?php 
        include_once 'resource/navbar.php';
    ?>


<div class="container text-center mt-2">
      <h1 class=" display-4 text-center">Lets Play</h1>
    <div class="row">
      <div class="col">
      <p>
        This is the website of the Lets Play game club.
        On the Club Games page you can browse through all the games owned by the club.
        Or sign up and use our database to keep track of your own game collection.
      </p>

      <?php
        if(!isset($_SESSION['username'])){
            echo '<p>You are currently not signed in <a href="LetsPlayLogin.php">Login </a>Not yet a member? <a href="SignUp.php">Signup</a></p>';
        }else{
            echo '<p>You are logged in as ' . 
            $_SESSION["username"] . 
            ' <a href="logout.php">Logout</a></p>';
        }
      ?>

      </div>
    </div>
  </div>

<?php 
    include_once 'resource/JSIncludes.php';
?> 
</body>
</html>
