<?php
include '../config.php';





?>

<!doctype html>
<html lang="en">
  
<?php $pageTitle = "Admin Dashboard"; include('includes/header.php');?>

    <section>
        <div class="container p-5">
            <h1>Admin Dashboard</h1>
            <?php echo "<p> Hey there, " . $firstname . " $lastname" ."." ."</p>"; ?>
        </div>
    
        <div class="container">
          <div class="row">
            
            <div class="col-md-2 d-flex">
              <div class="card border-dark mb-3">
                <div class="card-body">
                  <h5 class="card-title">Manage members</h5>
                  <p class="card-text">View and edit members</p>
                  <a href="managemembers.php" class="stretched-link"></a>
                </div>
              </div>
            </div>

            <div class="col-md-2 d-flex">
              <div class="card border-dark mb-3">
                <div class="card-body">
                  <h5 class="card-title">Manage suppliers</h5>
                  <p class="card-text">View and edit suppliers</p>
                  <a href="managesuppliers.php" class="stretched-link"></a>
                </div>
              </div>
            </div>

            <div class="col-md-2 d-flex">
              <div class="card border-dark mb-3">
                <div class="card-body">
                  <h5 class="card-title">Password Reset Request</h5>
                  <p class="card-text">View requests sent by customers to reset password</p>
                  <a href="resetrequests.php" class="stretched-link"></a>
                </div>
              </div>
            </div>

            <div class="col-md-2 d-flex">
              <div class="card border-dark mb-3">
                <div class="card-body">
                  <h5 class="card-title">Log Out</h5>
                  <p class="card-text">Log out of your acccount</p>
                  <a href="../logout.php" class="stretched-link"></a>
                </div>
              </div>
            </div>


        </div>

          
          
        </div>



      </div>


    </section>
    <?php include('includes/footer.php');?>
  </body>

</html>
