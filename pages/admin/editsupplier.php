<?php

include '../usrinfo.php';

if (is_null($_SESSION['usrAuth'])) {
  header("Location: ../login.php");
}elseif (is_null($_GET['id'])){
    header("Location: managesuppliers.php?id=invalid");
}


if (isset($_GET['id'])){
  $id = $_GET["id"];
  $args = "SELECT * FROM suppliers where id=$id";
  $result = mysqli_query($conn, $args) or die("database error:". mysqli_error($conn));

  $row = mysqli_fetch_assoc($result);

  if(isset($_POST['savedata'])){

      $newName=$_POST['cName'];
      $newEmail=$_POST['cEmail'];
      $newPhone=$_POST['cPhone'];
      $newAddress=$_POST['cAddress'];
      $newFoodTypes=$_POST['cFoodTypes'];
      $newStatus=$_POST['cStatus'];

      $query = "UPDATE suppliers SET company_name='$newName', email='$newEmail', phone_number='$newPhone', address='$newAddress', food_types='$newFoodTypes', isActive='$newStatus' WHERE id=$id";

      $result = mysqli_query($conn, $query) or die("database error:". mysqli_error($conn));
      if($result)
      {
        echo header("Location: managesuppliers.php?id=updated");
      }

  }elseif(isset($_POST['deldata'])){
      $query = "DELETE FROM suppliers where id=$id";

      $result = mysqli_query($conn, $query) or die("database error:". mysqli_error($conn));
      if($result)
      {
      echo header("Location: managesuppliers.php?id=deleted");
      }
  }elseif(isset($_POST['discarddata'])){
      echo header("Location: managesuppliers.php");
  }
}


?>
<!doctype html>
<html lang="en">
  
<?php $pageTitle = "Editing Supplier"; include('includes/header.php');?>
    
    <section>
        <div class="container p-5">
            <h1>Edit Supplier</h1>
            <p>Currently Editing: <?php echo $row ['company_name']; ?></p>
        </div>
    
        <div class="container">
            <form action="" method="POST">

              <div class="form-group row mb-3">
                <label for="isbn" class="col-sm-2 col-form-label">Company name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="cName" value="<?php echo $row ['company_name']; ?>" required>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="cEmail" value="<?php echo $row ['email']; ?>" required>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="description" class="col-sm-2 col-form-label">Phone number</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" name="cPhone" value="<?php echo $row ['phone_number']; ?>" required>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="author" class="col-sm-2 col-form-label">Address</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="cAddress" value="<?php echo $row ['address']; ?>" required>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="publisher" class="col-sm-2 col-form-label">Types of food sold</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="cFoodTypes" value="<?php echo $row ['food_types']; ?>" required>
                </div>
              </div>

              <div class="form-group row mb-3">
                <label for="publisher" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-10">
                <div class="col-sm-10  mb-3">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="cStatus" id="active" value="1" <?php echo ($row ['isActive'] == 1) ? "checked":""; ?> required>
                    <label class="form-check-label" for="active">Active</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="cStatus" id="inactive" value="0" <?php echo ($row ['isActive'] == 0) ? "checked":""; ?> required>
                    <label class="form-check-label" for="inactive">Inactive</label>
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
