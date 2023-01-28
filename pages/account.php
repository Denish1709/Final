<?php


if (isset($_GET['id'])){
  $id = $_GET["id"];
  if ($id == 'unauthorized'){
    echo '<div class="alert alert-danger" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> Unauthorized! Only authorized users can access admin panel!</h4>
    </div>';
  }elseif($id == 'updated'){
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> Details succesfully updated!</h4>
    </div>';
  }
}

?>

<!doctype html>
<html lang="en">
  
<?php $pageTitle = "My Account"; include('./parts/header.php');?>

<section>
    <div class="container p-5">
        <h1>My Account</h1>
    </div>

    <div class="container">
      <div class="row">


        <div class="col-md-2 d-flex">
          <div class="card border-dark mb-3">
            <div class="card-body">
              <h5 class="card-title">My Order History</h5>
              <p class="card-text">View your purchases and invoices</p>
              <a href="orderhistory.php" class="stretched-link"></a>
            </div>
          </div>
        </div>

        <div class="col-md-2 d-flex">
          <div class="card border-dark mb-3">
            <div class="card-body">
              <h5 class="card-title">My Details</h5>
              <p class="card-text">Update your personal details</p>
              <a href="details.php" class="stretched-link"></a>
            </div>
          </div>
        </div>

        <div class="col-md-2 d-flex">
          <div class="card border-dark mb-3">
            <div class="card-body">
              <h5 class="card-title">Log Out</h5>
              <p class="card-text">Log out of your account</p>
              <a href="logout.php" class="stretched-link"></a>
            </div>
          </div>
        </div>


    </div>
    </div>
  </div>
</section>

<!-- Footer -->
<?php include('./parts/footer.php');?>
</body>


</html>
