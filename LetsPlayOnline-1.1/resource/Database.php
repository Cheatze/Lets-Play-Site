<?php
// $host = 'localhost';
 $username = 'tjitze';
 $dsn = 'mysql:host=localhost:3306; dbname=tjitze_database';
 $password = '@yN6kW#z!qu7';

 
 try{

    $db = new PDO($dsn, $username, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    //echo "Connected? Good.";

}catch(PDOException $ex){

    echo "Connection failed." . "<br>" . $ex->getMessage();

}

 ?>