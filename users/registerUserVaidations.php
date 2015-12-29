<?php

function usernameExists($username,$conn) {
   
    $query = "SELECT count(*) FROM user WHERE username=?";
    $stm = $conn->prepare($query);

    $stm->bind_param("s", $username);

    $stm->execute();

    $count = $stm->get_result()->fetch_all()[0][0];
    $stm->close();
    return $count > 0;
}

function validateUserName($username,$conn){
    
    $erroList = [];
    if (usernameExists($username,$conn)) {
        
         array_push($erroList, "Username already exists");
    }
    if (strlen($username) == 0) {
        array_push($erroList, "Please supply username");
    }
    
    return $erroList;
}