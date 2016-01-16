<?php

$name = $_POST['name'];
$message = $_POST['message'];
$mail = $_POST['mail'];
$phone = $_POST['phone'];




$email_message = "
Name: ".$name."
Email: ".$email."
Phone: ".$phone."
Message: ".$message."
";


mail("skyofshadow@hotmail.com" , "Νέο Μήνυμα" , $email_message);
header("Location: index.php");
// Check, if message sent to your email
// display message "We've recived your information"
if($send_contact){
    echo "Λάβαμε το μύνημά σας";
}
else {
    echo "ΣΦΑΛΜΑ";
}
?>