<?php
include_once 'config.php';


$email = $_SESSION['supAuth'];

$sql = "SELECT * FROM users INNER JOIN suppliers ON users.userid=suppliers.id WHERE users.email='$email'";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
  $row = mysqli_fetch_assoc($result);

  $userid = $row['userid'];
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  $email = $row['email'];
  $phonenum = $row['phonenum'];
  $isAdmin = $row['user_type'];

  //supplier details
  $supplierId = $row['id'];
  $companyName = $row['company_name'];
  $businessPhone = $row['phone_number'];
  $address = $row['address'];
  $businessEmail = $row['email'];
  $foodTypes = $row['food_types'];
} else {
  echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
  <h4><i class="icon fa fa-times "></i> Error! User not found in database!</h4>
  </div>';
}
?>