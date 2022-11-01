<?php
include_once 'resource/session.php';
include_once 'resource/Database.php';

if(!isset($_SESSION['username'])){
    header('location: index.php');
}

if(isset($_SESSION['title'])){
    unset($_SESSION['title']);
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

    <link rel="stylesheet" href="style/searchStyle.css">

    <title>Lets Play</title>

</head>
<body>

<?php 
    include_once 'resource/navbar.php';
?>


<div class="container text-center mt-2">
    <h1 class=" display-4 text-center">Lets Play Search</h1>
    <div class="row">
        <div class="col">
            <form method="post" action="results.php">
                <div class="form-group ml-20px justify-content-center">
                    <label>Search</label>
                    <input type="text" name="name" class="form-control text-center" placeholder="Enter name">
                </div>
                <div class="form-group form-check">

                </div>
                <button type="submit" name="searchBtn" class="btn btn-primary">Search by name</button>
            </form>
        </div>
    </div>

</div>


<?php 
    include_once 'resource/JSIncludes.php';
?> 
</body>
</html>