<?php 

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'bayfront_hotel';  //change

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//Checking the connection
if(mysqli_connect_errno()) {
    die('Database connection failed ' .mysqli_connect_error());
}
// else {
//     echo 'success';
// }
