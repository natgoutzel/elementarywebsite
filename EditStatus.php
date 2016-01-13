<?php
require_once 'helpers/dbConnectioni.php';
//if(!isset($_GET['id']))
//    return;
//
//else {


$conn = getDbConnection();

$isPost = filter_input(INPUT_GET,"id");
if (!isset($isPost )) {
        return;}
else {

$ttid=filter_input(INPUT_GET,"id");
echo $ttid;
$updatesql = "UPDATE user SET status =0  WHERE user_id= ?";
$updatestm = $conn->prepare($updatesql);
$updatestm -> bind_param("i",$ttid);
$update = $updatestm->execute();
                        
if ($update==true) {
    echo 'status changed';
}
else {
       echo "something gone wrong";
        }    
}        


 $conn->close();


?>