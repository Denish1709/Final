<?php


include 'config.php';

if (isset($_SESSION['usrAuth'])) {
  header("Location: details.php?id=loggedin");
}

if(isset($_POST['resetbtn'])) {
  
  $email = $_POST['email'];
  $phonenum = $_POST['phonenum'];
  $npassword = $_POST['npassword'];
  $rnpassword = $_POST['rnpassword'];

  if(isset($_POST['cpassCheckbox'])) {
    $cpassword = $_POST['cpassword'];
    $rcpassword = $_POST['rcpassword'];
  }else{
    $cpassword = "N/A";
  }

  if($npassword == $rnpassword) {
    $args = "SELECT * from users WHERE email='$email'";
    $result = mysqli_query($conn, $args);
    if ($result->num_rows > 0) {
      $row = mysqli_fetch_assoc($result);
      $userid = $row['userid'];
      $oldfirstname = $row['firstname'];
      $oldemail = $row['email'];
      $oldphonenum = $row['phonenum'];
      

      if($email == $oldemail && $phonenum == $oldphonenum){
        $args = "INSERT INTO passwordreset (userid, cpassword, npassword) VALUES ('$userid', '$cpassword', '$npassword')";
        $result = mysqli_query($conn, $args);
        if ($result) {
          echo '<div class="alert alert-success" id="flash-msg">
          <h4><i class="icon fa fa-check "></i> Request has been submitted to system admin!</h4>
          </div>';
        } else {
          echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
          <h4><i class="icon fa fa-times "></i> Error! User not found in database!</h4>
          </div>';
        }
      }else{
        echo '<div class="alert alert-danger" id="flash-msg">
        <h4><i class="icon fa fa-times "></i> Email and Phone Number do not match a user!</h4>
        </div>';
      }

      
      
    } else {
      echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
      <h4><i class="icon fa fa-times "></i> Error! User not found in database!</h4>
      </div>';
    }
  }else{
    echo '<div class="alert alert-danger" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> New Passwords do not match!</h4>
    </div>';
  }
  
}

if (isset($_GET['id'])){
  $id = $_GET["id"];
  if ($id == 'incorrectpassword'){
    echo '<div class="alert alert-danger" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> Passwords do not match!</h4>
    </div>';
  }elseif($id == 'success'){
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> Request has been submitted to system admin!</h4>
    </div>';
  }elseif($id == 'deleted'){
  echo '<div class="alert alert-success" id="flash-msg">
  <h4><i class="icon fa fa-check "></i> User succesfully removed from system!</h4>
  </div>';
  }
}


?>
<!doctype html>
<html lang="en">
  
<?php $pageTitle = "Reset Password"; include('./parts/header.php');?>

    <section>
        <div class="container p-5">
            <h1>Forgot Your Password?</h1>
            <p>No worries, submit your password reset form and your request will be reviewed by the admin in 2-3 business days!</p>
        </div>
    
        <div class='container' >
            <form action='' method='POST'>

                <div class="form-group row " >
                    <label for="email" class="col-sm-2 col-form-label">Email Address<font color="red">*</font></label>
                    <div class="col-sm-10 mb-3" style="max-width: 350px;">
                    <input  type="text" class="form-control" name="email" placeholder="Email" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phonenum" class="col-sm-2 col-form-label">Phone number<font color="red">*</font></label>
                    <div class="col-sm-10 mb-3" style="max-width: 350px;">
                    <input type="text" class="form-control" name="phonenum" placeholder="Phone number" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label><input class="form-check-input" type="checkbox" name="cpassCheckbox" value="show">
                    Do you remember the current password?</label>
                </div>

                <div class="show hiddenelement">
                    <div class="form-group row">
                        <label for="cpassword" class="col-form-label" >Current Password</label>
                        <div class="col-sm-10 mb-3"  >
                        <input type="password" class="form-control" name="cpassword" placeholder="Current Password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="retypecpassword" class="col-form-label">Retype Current Password</label>
                        <div class="col-sm-10 mb-3"  >
                        <input type="password" class="form-control" name="rcpassword" placeholder="Retype Current Password">
                        </div>
                       
                    </div>
                </div>


                <div class="form-group row">
                    <label for="npassword" class="col-sm-2 col-form-label">New Password<font color="red">*</font></label>
                    <div class="col-sm-10 mb-3" style="max-width: 350px;">
                    <input type="password" class="form-control" name="npassword" placeholder="New Password" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="retypenpassword" class="col-sm-2 col-form-label">Retype New Password<font color="red">*</font></label>
                    <div class="col-sm-10 mb-3" style="max-width: 350px;">
                    <input type="password" class="form-control" name="rnpassword" placeholder="Retype New Password" required>
                    </div>
                    
                </div>


                <div class="form-group row">
                    <div class="col-sm-10 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck1" required>
                        <label class="form-check-label" for="gridCheck1">
                        By submitting, you agree to our <a href="tnc.php">terms & conditions</a> for password reset.<font color="red">*</font>
                        </label>
                    </div>
                    </div>
                </div>

              <div class="form-group row">
                <div class="col-sm-10 mb-3">
                  <button type="submit" name="resetbtn" class="btn btn-primary">Submit Request</button>
                </div>
              </div>
            </form>

            

          </div>
        </div>

    </section>
    <?php include('./parts/footer.php');?>
  </body>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script type="text/javascript">
                $(document).ready(function() {
                    $('input[type="checkbox"]').click(function() {
                        var inputValue = $(this).attr("value");
                        $("." + inputValue).toggle();

                    });
                });
  </script>
</html>
