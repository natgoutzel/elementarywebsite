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
//echo $ttid;
$selectsql = "SELECT  lessonprogram_file FROM lessonprogram WHERE lessonprogram_id= ?";
$selectstm = $conn->prepare($selectsql);
$selectstm -> bind_param("i",$ttid);
$select = $selectstm->execute();

echo 'lessonprogram_file';
//if ($select->num_rows > 0) {
//    // output data of each row
//    while($row = $select->fetch_assoc()) {
//        echo   $row['lessonprogram_file']. "<br>";
//    }
//}    

}
$conn->close();

?>