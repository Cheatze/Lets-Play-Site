<?php
include_once 'resource/Database.php';

include_once 'resource/session.php';
include_once 'resource/utilities.php';

if(!isset($_SESSION['username'])){
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

    <link rel="stylesheet" href="style/LetsPlay.css">

    <link rel="stylesheet" type="text/css" href="style/style.css"></link>

    <!-- JS form validation script-->
    <script type="text/javascript" src="resource/scripts.js"></script>

    <title>Lets Play Game Entry</title>

</head>
<body>

<?php 
        include_once 'resource/navbar.php';
?>


<div class="container">
    <h1 class="text-center display-4">Lets Play Game Entry</h1>
</div>


<br>

<!--remove the js function for testing of php validation put back after method
    onsubmit="return validateForm()"
    change for game entry
 -->
 <div class="container w-50 p-3" >
    <form name="gamer" action="upload.php" method="post" onsubmit="return validateForm()" enctype="multipart/form-data">

        <div class="form-group ml-20px">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" class="form-control" aria-describedby="emailHelp" placeholder="Enter Name" required>
        </div>
        <!--change to number of players
            <input type="number" id="quantity" name="players" min="1" max="12"> 
        -->
        <div class="form-group">
            <label for="exampleInputPlayers">Number of players</label>
            <input type="number" class="form-control w-25 p-3" name="players" min="1" max="12" required>
        </div>
        
        <div class="form-group">
            <label for="exampleInputDescription">Description (optional)</label>
            <textarea name="description" rows="5" cols="30"></textarea>
        </div>
            
        <div class="form-group">
            <label for="exampleInputPassword1">Select image to upload: (optional)</label>
            <input type="file" name="fileToUpload" class="form-control" id="fileToUpload" placeholder="">
        </div>

        <button type="submit" name="insertBtn" value="insertBtn"  class="btn btn-primary">Submit</button>
    </form>
 </div>


<br>

<?php 
        include_once 'resource/JSIncludes.php';
    ?> 
</body>
</html>