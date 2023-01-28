<?php

  

if (isset($_GET['id'])){
  $id = $_GET["id"];
  if ($id == 'invalid'){
    echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> Wrong email or password!</h4>
    </div>';
  }elseif($id == 'error'){
    echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> error!</h4>
    </div>';
  }
  
}

?>
<!doctype html>
<html lang="en">

<?php $pageTitle = "Login"; include('includes/header.php');?>
  
<section>
    <div class="container p-5">
        <h1>Supplier Login</h1>
        <p>Log in to your manage your stocks and profile!</p>
    </div>

    <div class="container-fluid" style="max-width: 500px;">
      <form action='../auth.php' method='POST'>
        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" required>
        </div>  
        <div class="d-grid gap-2">
          <button type="submit" name ="login" class="btn btn-success btn-block">Log in</button>
        </div>

      </form>

      <a class="dropdown-item mt-3" href="resetpassword.php">Forgot password?</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="../login.php">Login as Customer</a>



    </div>



  </div>


</section>
<?php include('includes/footer.php');?>
</body>



</html>
