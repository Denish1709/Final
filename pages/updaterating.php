<?php
include 'config.php';


$usrAuth = $_SESSION['usrAuth'];

$args = "SELECT * FROM users WHERE email='$usrAuth'";
$result = mysqli_query($conn, $args);
if ($result->num_rows > 0) {
  $row = mysqli_fetch_assoc($result);
  $firstname = $row['firstname'];
  $lastname = $row['lastname'];
  $email = $row['email'];
  $password = $row['password'];
  $phonenum = $row['phonenum'];
}

//uncomplete edit sqp function
if(isset($_POST['rate'])) {
    $givenRating = $_POST['rate'];
    $givenFor = $_POST['productId'];
    $supplierId = $_POST['supplierId'];
   
    $args = "SELECT * FROM supplier_rating WHERE order_id='$givenFor'";
    $result = mysqli_query($conn, $args);
    if (!$result->num_rows > 0){
        $args = "INSERT INTO supplier_rating(order_id, supplier_id, rating) VALUES ($givenFor, $supplierId, $givenRating)";
        $result = mysqli_query($conn, $args);
        if ($result) {
            header("Location: orderhistory.php?id=rated");
        } else {
            echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
            <h4><i class="icon fa fa-times "></i> Error!</h4>
            </div>';
        }     
    } else {
    echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> You have rated for this product already!</h4>
    </div>';
    }     
    
} 

?>