<?php

include '../usrinfo.php';

if (is_null($_SESSION['usrAuth'])) {
  header("Location: ../login.php");
}elseif (is_null($_GET['id'])){
    header("Location: managemembers.php?id=invalid");
}


if (isset($_GET['id'])){
  $id = $_GET["id"];
  $args = "SELECT userid, firstname, lastname, phonenum, email, password FROM users where userid=$id";
  $result = mysqli_query($conn, $args) or die("database error:". mysqli_error($conn));

  $row = mysqli_fetch_assoc($result);

  if(isset($_POST['savedata'])){

      $nfirstname=$_POST['fname'];
      $nlastname=$_POST['lname'];
      $nphonenum=$_POST['pnum'];
      $nemail=$_POST['email'];
      $npassword=$_POST['password'];

      $query = "UPDATE users SET firstname='$nfirstname', lastname='$nlastname', phonenum='$nphonenum', email='$nemail', password='$npassword' WHERE userid=$id";

      $result = mysqli_query($conn, $query) or die("database error:". mysqli_error($conn));
      if($result)
      {
        echo header("Location: managemembers.php?id=updated");
      }

  }elseif(isset($_POST['deldata'])){
      $query = "DELETE FROM users where userid=$id";

      $result = mysqli_query($conn, $query) or die("database error:". mysqli_error($conn));
      if($result)
      {
      echo header("Location: managemembers.php?id=deleted");
      }
  }elseif(isset($_POST['discarddata'])){
      echo header("Location: managemembers.php");
  }
}


?>
<!doctype html>
<html lang="en">
  
<?php $pageTitle = "Manage User"; include('includes/header.php');?>
    
    <section>
        <div class="container p-5">
            <h1>Edit User Data</h1>
            <p>Currently Editing: <?php echo $row ['firstname'] . " "; echo $row ['lastname']; ?></p>
        </div>
    
        <div class="container">
            <form action="" method="POST">

              <div class="form-group row mb-3">
                <label for="isbn" class="col-sm-2 col-form-label">First name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="fname" value="<?php echo $row ['firstname']; ?>" required>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Last Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="lname" value="<?php echo $row ['lastname']; ?>" required>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="description" class="col-sm-2 col-form-label">Phone Number</label>
                <div class="col-sm-10">
                  <input type="tel" pattern="^\d{10}$" class="form-control" name="pnum" value="<?php echo $row ['phonenum']; ?>" required>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="author" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" name="email" value="<?php echo $row ['email']; ?>" required>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="publisher" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="password" value="<?php echo $row ['password']; ?>" required>
                </div>
              </div>

              <div class="form-group row mb-3">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-success" name="savedata">Save changes</button>
                  <button type="submit" class="btn btn-outline-primary" name="discarddata">Discard changes</button>
                  <button type="submit" class="btn btn-outline-danger" name="deldata">Delete User</button>
                </div>
              </div>
            </form>
        </div>
      </div>
    </section>
    <?php include('includes/footer.php');?>
  </body>

</html>
