<?php 
echo 'Level 10';
session_start();

$_SESSION = array();

if(isset($_POST['submit'])) {
    if(isset($_COOKIE[session_name()])) {
        //setcookie(session name, value, expired time, affect side)
        setcookie(session_name(), '', time()-86400, '/');  //86400s and / mean root folder
    }

    session_destroy();

    header("Location: ../index.php?logout=yes");  //?parameters

}




?>