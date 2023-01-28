<?php

$server = "localhost";
$user = "root";
$pass = "";
$database = "dbserver";

$conn = mysqli_connect($server, $user, $pass, $database);

if(!$conn){
    echo "connection failed";
}

?>
