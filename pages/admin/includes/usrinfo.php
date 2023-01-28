<?php
include_once 'config.php';


$email = $_SESSION['usrAuth'];

$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
  $row = mysqli_fetch_assoc($result);

  $userid = $row['userid'];
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  $email = $row['email'];
  $phonenum = $row['phonenum'];
  $isAdmin = $row['user_type'];
} else {
  echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
  <h4><i class="icon fa fa-times "></i> Error! User not found in database!</h4>
  </div>';
}
?>