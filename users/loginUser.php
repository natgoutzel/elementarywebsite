<?php
require_once '../helpers/dbConnectioni.php';

$conn = getDbConnection();
$isPost = filter_input(INPUT_POST, "login");

if (isset($isPost)) {
    
$username = filter_input(INPUT_POST, 'username', FILTER_DEFAULT);
$pass = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);

    if (strlen($username)==0 || strlen($pass)==0) {
        echo "Please enter username and password";
        exit();
    }
    
$hashpass= password_hash($pass, PASSWORD_BCRYPT, array('cost' => 10));  

$sql = "SELECT username,password FROM user WHERE username=? && password=?";
    $stm = $conn->prepare($sql);
    $stm->bind_param("ss", $username, $hashpass);
    $resutl = $stm->execute();
    
    if ($resutl==TRUE) {
       $cookie= FormsAuthentication::setAuthCookie($username);
        echo 'Welcome %s', $cookie;
    }  else {
        echo 'Username or Password incorrect';
    }
}

$conn->close();


?>