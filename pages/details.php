<?php


if (is_null($_SESSION['usrAuth'])) {
  header("Location: login.php");
}else{
  include 'usrinfo.php';
}

if (isset($_GET['id'])){
  $id = $_GET["id"];
  if ($id == 'updated'){
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> Details succesfully updated!</h4>
    </div>';
  }elseif($id == 'loggedin'){
  echo '<div class="alert alert-warning" id="flash-msg">
  <h4><i class="icon fa fa-times "></i> You are logged in! Please reset your password here!</h4>
  </div>';
  }
}

?>

<!doctype html>
<html lang="en">
  
<?php $pageTitle = "My Account"; include('./parts/header.php');?>

    <section>
        <div class="container p-5">
            <h1>My Details</h1>
            <p>Keep your personal details up to date!</p>
        </div>

        <div class="container" id="group">
          <table class="table table-sm">
            <tbody>
              <tr>
                <th scope="row">First Name:</th>
                <td><?php echo "<p>". $firstname."</p>"; ?></td>
                <td><button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="collapse" data-bs-target="#chgFname" aria-expanded="false">Change</button></td>
              </tr>
              <tr>
                <th scope="row">Last Name:</th>
                <td><?php echo "<p>" . $lastname."</p>"; ?></td>
                <td><button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="collapse" data-bs-target="#chgLname" aria-expanded="false">Change</button></td>
              </tr>
              <tr>
                <th scope="row">Email:</th> 
                <td><?php echo "<p>" . $email."</p>"; ?></td>
                <td><button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="collapse" data-bs-target="#chgEmail" aria-expanded="false">Change</button></td>
              </tr>
              <tr>
                <th scope="row">Password:</th>
                <td><p>********</p></td>
                <td><button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="collapse" data-bs-target="#chgPassword" aria-expanded="false">Change</button></td>
              </tr>
              <tr>
                <th scope="row">Phone Number:</th>
                <td><?php echo "<p>" . $phonenum."</p>"; ?></td>
                <td><button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="collapse" data-bs-target="#chgPnum" aria-expanded="false">Change</button></td>
              </tr>
            </tbody>
          </table>

          <div class="collapse" id="chgFname" data-bs-parent="#group">
            <div class="card card-body">
              <form action="updatedetails.php" method='POST'>
                
                <div class="mb-3">
                    <label for="newFname" class="form-label">Enter New First Name:</label>
                    <input type="text" class="form-control" name="newFname">
                    
                </div>

                <button type="submit" name ="updateFname" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>

          <div class="collapse" id="chgLname" data-bs-parent="#group">
            <div class="card card-body">
              <form action="updatedetails.php" method='POST'>

                <div class="mb-3">
                    <label for="newLname" class="form-label">Enter New Last Name:</label>
                    <input type="text" class="form-control" name="newLname">

                </div>

                <button type="submit" name ="updateLname" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>

          <div class="collapse" id="chgEmail" data-bs-parent="#group">
            <div class="card card-body">
              <form action="updatedetails.php" method='POST'>

                <div class="mb-3">
                    <label for="newEmail" class="form-label">Enter New E-mail:</label>
                    <input type="text" class="form-control" name="newEmail">

                </div>

                <button type="submit" name ="updateEmail" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>

          <div class="collapse" id="chgPassword" data-bs-parent="#group">
            <div class="card card-body">
              <form action="updatedetails.php" method='POST'>

                <div class="mb-3">
                    <label for="newPass" class="form-label">Enter New Password:</label>
                    <input type="text" class="form-control" name="newPass">

                </div>

                <button type="submit" name ="updatePassword" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>

          <div class="collapse" id="chgPnum" data-bs-parent="#group">
            <div class="card card-body">
              <form action="updatedetails.php" method='POST'>

                <div class="mb-3">
                    <label for="newPnum" class="form-label">Enter New Phone Number:</label>
                    <input type="text" class="form-control" name="newPnum">

                </div>

                <button type="submit" name ="updatePhonenum" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include('footer.php');?>
  </body>
</html>
