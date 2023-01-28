<?php

include '../config.php';
include '../usrinfo.php';


if (is_null($_SESSION['usrAuth'])) {
  header("Location: login.php");
}

if ($isAdmin != "1"){
  header("Location: ../account.php?id=unauthorized");
}


if (isset($_GET['id'])){
  $id = $_GET["id"];
  
  $query = "DELETE FROM users where userid=$id";

  $conn->query($query) or die($conn->error());

  echo header("Location: managemembers.php?id=deleted");

}

?>