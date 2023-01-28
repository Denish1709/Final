<?php


include '../config.php';

if (isset($_SESSION['usrAuth'])) {
  session_abort();
  include '../usrinfo.php';
}

if (is_null($_SESSION['usrAuth'])) {
  header("Location: ../login.php");
}

if ($isAdmin != "1"){
  header("Location: ../account.php?id=unauthorized");
}

// request data
$args = "SELECT * FROM passwordreset JOIN users ON (passwordreset.userid = users.userid)";
$result = mysqli_query($conn, $args) or die("database error:". mysqli_error($conn));

//approve code

if (isset($_GET['id'])){
  $id = $_GET["id"];

  $query = "DELETE FROM passwordreset where userid=$id";
  $result = mysqli_query($conn, $query) or die("database error:". mysqli_error($conn));
  if ($result) {
      header( "Location: resetrequests.php?id=rejected" ); die;
  } else {
    echo 'something error';
    }
}


?>
