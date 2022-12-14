<?php
include_once 'resource/session.php';
include_once 'resource/Database.php';

//The user's id, which should be present in the GET variable "uid"
$userId = isset($_GET['uid']) ? trim($_GET['uid']) : '';
//The token for the request, which should be present in the GET variable "t"
$token = isset($_GET['t']) ? trim($_GET['t']) : '';
//The id for the request, which should be present in the GET variable "id"
$passwordRequestId = isset($_GET['id']) ? trim($_GET['id']) : '';

//Now to query the password_reset_request table and
//make sure that the GET variables belong to
//a valid forgot password request.
 
$sql = "
      SELECT id, user_id, date_requested 
      FROM password_reset_request
      WHERE 
        user_id = :user_id AND 
        token = :token AND 
        id = :id
";

$statement = $db->prepare($sql);

$statement->execute(array(
    "user_id" => $userId,
    "id" => $passwordRequestId,
    "token" => $token
));


//Fetch result as an associative array.
$requestInfo = $statement->fetch(PDO::FETCH_ASSOC);


//If $requestInfo is empty, it means that this
//is not a valid forgot password request. i.e. Somebody could be
//changing GET values and trying to hack our
//forgot password system.
if(empty($requestInfo)){
    echo 'Invalid request!';
    exit;
}


//The request is valid, so give them a session variable
//that gives them access to the reset password form.
$_SESSION['user_id_reset_pass'] = $userId;

//Redirect to reset password form.
header('Location: Reset.php');
exit;


?>