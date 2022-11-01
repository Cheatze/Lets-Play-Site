<?php 
include_once 'resource/session.php';
include_once 'resource/Database.php';
include_once 'resource/utilities.php';


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

    <link rel="stylesheet" href="style/style.css">

    <title>Lets Play</title>
</head>
<body>
<?php 
    include_once 'resource/navbar.php';
?>


<div class="container">
    <h1>Lets Play password reset request</h1>
    <p>Your confirmation email may appear in your spam folder.</p>
</div>
<div class="container">
    <form action="pwr_Email.php" method="post">
        <div class="form-group ml-20px">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <button type="submit" name="passwordResetBtn"  class="btn btn-primary">Submit</button>
    </form>
</div>

<?php 
    include_once 'resource/JSIncludes.php';
?> 
</body>
</html>