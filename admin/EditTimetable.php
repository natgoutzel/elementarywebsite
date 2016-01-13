<?php

require_once '../helpers/dbConnectioni.php';
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
$deletesql = "DELETE FROM lessonprogram WHERE lessonprogram_id= ?";
$deletestm = $conn->prepare($deletesql);
$deletestm -> bind_param("i",$ttid);
$delete = $deletestm->execute();
                        
if ($delete==true) {
    echo 'delete successful';
}
else {
       echo "something gone wrong";
        }    
}        


 $conn->close();





//Exeis to 	timetableid mporeis na kaneis oti erotima thes apo edo kai kato

	
?>
