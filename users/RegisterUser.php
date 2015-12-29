<?php

//SAMLE LOGIN
    

    //$username = filter_input(INPUT_POST, 'username', FILTER_DEFAULT);
    //$pass = filter_input(INPUT_POST, 'username', FILTER_DEFAULT);
    
    //$hasPass = "sfsdf";
    //Check  database if both exists
    //If OK
    //FormsAuthentication::setAuthCookie($username);
    //ELSE
    //"Usename or password incorrect";
    
//

//Sample CODE FOr Giving permissions only to logged in users
//$val = FormsAuthentication::GetAuthCookieValue();
//if (strlen($val)==0){
  //  "You are not authorized";
    //Redirect sto login
    //header("Locatio")
//}else{
    //TO $val einia to userName
//}

// 


require_once '../helpers/dbConnectioni.php';
require_once 'registerUserVaidations.php';

$conn = getDbConnection();


$isPost = filter_input(INPUT_POST, "registration");

if (isset($isPost)) {

    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);

    if (strlen($firstname) == 0 || strlen($lastname) == 0) {
        echo "Please supply first name and last name";
        exit();
    }

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $errorsUsername = validateUserName($username, $conn);
   
    if (count($errorsUsername)!=0){
        echo join(",", $errorsUsername);
        exit();
    }

    $passwordRaw = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
    $conpasswordRaw = filter_input(INPUT_POST, 'cpassword', FILTER_DEFAULT);

    if (strlen($passwordRaw) == 0) {
        echo "Please supply password";
        exit();
    }
    if ($passwordRaw !== $conpasswordRaw) {
        echo "Password nad confirm password not equal";
        exit();
    }

    $passwordResult = filter_var($passwordRaw, FILTER_SANITIZE_STRING);
    if ($passwordResult !== $passwordRaw) {
        echo "Please remove special characters like < >";
        exit();
    }

    //If we get here store it to database

    $passwordHash = password_hash($passwordResult, PASSWORD_BCRYPT, array('cost' => 10));
    $sql = "INSERT INTO user(username,user_lastname,usr_firstname,status,admin,password) VALUES(?,?,?,?,?,?)";
    $stm = $conn->prepare($sql);

    $status = 1;
    $admin = 0;
    $stm->bind_param("sssiis", $username, $lastname, $firstname, $status, $admin, $passwordHash);


    $resutl = $stm->execute();
    if ($resutl === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "You should NOT be here";
}

$conn->close();


//if (isset()){
//    echo "You should  be here";
//}else{
//    echo "You should NOT be here";
//}
//if (isset($_POST['registration'])) {
//    $firstname = mysql_real_escape_string($_POST['firstname']);
//    $lastname = mysql_real_escape_string($_POST['lastname']);
//    $username = mysql_real_escape_string($_POST['username']);
//    $password = password_hash($_POST['password'], PASSWORD_BCRYPT, array('cost' => 10));
//    $conpassword = password_hash($_POST['confirm password'], PASSWORD_BCRYPT, array('cost' => 10));
//
////        //check password
////        if($password !=$conpassword){
////            echo 'passwords are not equal';
////             $conn->close();
////        }
////        
////        //check username
////        if(isUsernameAvailable==FALSE){
////            echo 'Username already exists';
////            $conn->close();
////        }
////        
//
//    $sql = "INSERT INTO user(username,user_lastname,user_firstname,status,admin,password) VALUES('$username','$lastname','$firstname','1','0','$password')";
//    if (mysqli_query($conn, $sql)) {
//        echo "New record created successfully";
//    } else {
//        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//    }
//}
//$conn->close();
//function isUsernameAvailable($username) {
//
//$rowCount = "SELECT count(*) FROM user WHERE username='$username'";
//
// if($rowCount > 0){
//        $avail=FALSE;//If there is a  record match in the Database - Not Available
//    }
//    else {
//        $avail=TRUE;    // Username is available 
//    }
//    return $avail;
//}
?>