<?php
include_once 'resource/session.php';
include_once 'resource/Database.php';

if(!isset($_SESSION['username'])){
    header('location: index.php');
}

//number of entries shown on a page
$results_per_page = 5;

if (isset ($_GET['page']) ) { 
    $page = $_GET['page'];  
} else {  
    $page = 1;   
}  

//determine the sql LIMIT starting number for the results on the displaying page  
$start_from = ($page-1) * $results_per_page;   

//hard code this to 'CLUB' for the page for browsing club owned games
$owner = $_SESSION['username'];

$query = "SELECT * FROM games WHERE owner = '$owner' LIMIT $start_from, $results_per_page"; 

//retrieve results from query
$Rowresult = $db->query($query);

//get number of results
$number_of_result = $Rowresult->rowCount();

//determine the total number of pages available  
$number_of_page = ceil ($number_of_result / $results_per_page);  

?>

<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://kit.fontawesome.com/5b145bfb33.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="style/LetsPlay.css">

    <link rel="stylesheet" href="style/searchStyle.css">

</head>
<body>

<?php 
    include_once 'resource/navbar.php';
?>


<div class="container">
    <br>
    <div>
        <h1>Games</h1>
        <table class="table table-striped table-condensed table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Players</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach  ($db->query($query) as $row) {
                ?>
                <tr>
                <td><a href="game.php?id=<?php echo $row['id']?>"><?php echo $row['Name'] ?></a></td>                        
                        <td><?php echo $row["Players"] ?></td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>

        <div class="pagination">"
            <?php
                $query = "select count(*) from games"; 
                $result = $db->query($query);
                $number_of_result = $result->rowCount();
                $total_records = count($row);

                echo "<br>";

                // Number of pages required.   
                $total_pages = ceil($total_records / $results_per_page);     
                $pagLink = "";     

                if($page>=2){   
                    echo "<a href='browse.php?page=".($page-1)."'>  Prev </a>";   
                }  

                for($i=1; $i<=$total_pages; $i++){
                    if($i == $page){
                        $pagLink = "<a class = 'active' href='browse.php?page="  
                        .$i."'>".$i." </a>";  
                    }else{
                        $pagLink .= "<a href='browse.php?page=".$i."'>   
                        ".$i." </a>";  
                    }
                };

                echo $pagLink;

                if($page<$total_pages){
                    echo "<a href='browse.php?page=".($page+1)."'>  Next </a>";  
                }
            ?>
        </div>

        <div class="inline">
            <input id="page" type="number" min="1" max="<?php echo $total_pages ?>"
                placeholder="<?php echo $page.'/'.$total_pages; ?>" required>
            <button onClick="go2Page();">Go</button>
        </div>
    </div>
</div>


<?php 
    include_once 'resource/JSIncludes.php';
?> 
<script>
    function go2Page(){
        var page = document.getElementById("page").value;
        page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   
        window.location.href = 'browse.php?page='+page;  
      }
</script>
</body>
</html>