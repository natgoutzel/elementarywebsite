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
$updateAdminSql = "UPDATE user SET admin =1  WHERE user_id= ?";
$updateAdminStm = $conn->prepare($updateAdminSql);
$updateAdminStm -> bind_param("i",$ttid);
$updateAdmin = $updateAdminStm->execute();

//apo cookie na parw to id tou admin
$ttid1=1;
$updateAdminSql1 = "UPDATE user SET admin =0  WHERE user_id= ?";
$updateAdminStm1 = $conn->prepare($updateAdminSql1);

$updateAdminStm1 -> bind_param("i",$ttid1);
$updateAdmin1 = $updateAdminStm1->execute();

if ($updateAdmin==true && $updateAdmin1==true) {
    echo 'Admin changed';
}
else {
       echo "something gone wrong";
        }    
}        


 $conn->close();

?>