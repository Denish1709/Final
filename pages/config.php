<?php

$server = "localhost";
$user = "root";
$pass = "aqvEwR9D41FvwC6l";
$database = "Final";

$conn = mysqli_connect($server, $user, $pass, $database);

if(!$conn){
    echo "connection failed";
}

?>
