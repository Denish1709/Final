<?php

if (isset($_SESSION['usrAuth'])) {
  header("Location: account.php");
}

if (isset($_GET['id'])){
  $id = $_GET["id"];
  if ($id == 'userexist'){
    echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> A user is already registered with the email or phone number! Please login <a href="login.php">here</a>!</h4>
    </div>';
  }elseif ($id == 'invalidpassword'){
    echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> Passwords do not match! Try again!</h4> 
    </div>';
  }
}

?>
<!doctype html>
<html lang="en">

<?php $pageTitle = "Register"; include('./parts/header.php');?>
  
  <section>
      <div class="container p-5">
          <h1>Register an account!</h1>
          <p>Register as a member of <?php echo $siteName; ?> to enjoy more additional features!</p>
      </div>
      <div class='container mb-3' style="max-width: 50%;">
        <form action='auth.php' method='POST'>

          <div class="form-group row">
            <label for="firstname" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10 mb-3">
              <input type="text" class="form-control" name="firstname" placeholder="John" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10  mb-3">
              <input type="text" class="form-control" name="lastname" placeholder="Ive" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="phonenum" class="col-sm-2 col-form-label">Phone number</label>
            <div class="col-sm-10  mb-3">
              <input type="tel" pattern="^\d{10}$" class="form-control" name="phonenum" placeholder="012XXXXXXX" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email address</label>
            <div class="col-sm-10  mb-3">
              <input type="email" class="form-control" name="email" placeholder="example@email.com" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Gender</label>
            <div class="col-sm-10  mb-3">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="maler" value="M" required>
                <label class="form-check-label" for="maler">Male</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="femaler" value="F" required>
                <label class="form-check-label" for="femaler">Female</label>
              </div>
            </div>
          </div>

          

          <div class="form-group row">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10  mb-3">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="password2" class="col-sm-2 col-form-label">Retype Password</label>
            <div class="col-sm-10  mb-3">
              <input type="password" class="form-control" name="password2" placeholder="Retype Password" required>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-sm-10 mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck1" required>
                <label class="form-check-label" for="gridCheck1">
                  By signing up, you agree to our terms & conditions.
                </label>
              </div>
            </div>
          </div>
          <div class="d-grid mb-5">
            <button type="submit" name ="register" class="btn btn-success btn-block">Sign Up</button>
          </div>

        </form>
      </div>
    </div>


  </section>
  <?php include('./parts/footer.php');?>
</body>
</html>
