<?php
include_once 'resource/session.php';
include_once 'resource/Database.php';
include_once 'resource/utilities.php';


$id = $_GET['id'];
$user = "LetsPlay";

//for the sake of edit code
$_SESSION['id'] = $id;

$query = "SELECT * FROM games WHERE id = '$id' and owner = :username";

$statement = $db->prepare($query);

$statement->execute(array(':username' => $user));

$row = $statement->fetch();

$name = $row["Name"];
$players = $row["Players"];
$description = $row["description"];
$owner = $row['Owner'];
$file = $row['filename'];



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

</div>


<?php 
    include_once 'resource/JSIncludes.php';
?> 
</body>
</html>