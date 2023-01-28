<?php


if (is_null($_SESSION['supAuth'])) {
  header("Location: login.php");
}else{
  //include '../usrinfo.php';
  include 'includes/supinfo.php';
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
  
<?php $pageTitle = "Supplier Details"; include('includes/header.php');?>

    <section>
        <div class="container p-5">
            <h1>My Supplier Information</h1>
            <p>Up to date informations keeps your customers in touch!</p>
        </div>

        <div class="container" id="group">
          <table class="table table-sm">
            <tbody>
              <tr>
                <th scope="row">Company Name:</th>
                <td><?php echo "<p>". $companyName."</p>"; ?></td>
                <td><button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="collapse" data-bs-target="#editCompanyName" aria-expanded="false">Change</button></td>
              </tr>
              <tr>
                <th scope="row">Business Contact Number:</th>
                <td><?php echo "<p>" . $businessPhone."</p>"; ?></td>
                <td><button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="collapse" data-bs-target="#editContactNum" aria-expanded="false">Change</button></td>
              </tr>
              <tr>
                <th scope="row">Business Address:</th> 
                <td><?php echo "<p>" . $address."</p>"; ?></td>
                <td><button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="collapse" data-bs-target="#editAddress" aria-expanded="false">Change</button></td>
              </tr>
              <tr>
                <th scope="row">Business Email:</th>
                <td><?php echo "<p>" . $businessEmail."</p>"; ?></td>
                <td><button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="collapse" data-bs-target="#editEmail" aria-expanded="false">Change</button></td>
              </tr>
              <tr>
                <th scope="row">Targeted Food Types:</th>
                <td><?php echo "<p>" . $foodTypes."</p>"; ?></td>
                <td><button type="button" class="btn btn-outline-dark btn-sm" data-bs-toggle="collapse" data-bs-target="#editFoodTypes" aria-expanded="false">Change</button></td>
              </tr>
            </tbody>
          </table>

          <div class="collapse mb-3" id="editCompanyName" data-bs-parent="#group">
            <div class="card card-body">
              <form action="updatedetails.php" method='POST'>
                
                <div class="mb-3">
                    <label for="newFname" class="form-label">Enter New Company Name:</label>
                    <input type="text" class="form-control" name="newCname">
                    
                </div>

                <button type="submit" name ="updateCompanyName" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>

          <div class="collapse mb-3" id="editContactNum" data-bs-parent="#group">
            <div class="card card-body">
              <form action="updatedetails.php" method='POST'>

                <div class="mb-3">
                    <label for="newLname" class="form-label">Enter New Business Number:</label>
                    <input type="text" class="form-control" name="newContactNumber">

                </div>

                <button type="submit" name ="updateConNum" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>

          <div class="collapse mb-3" id="editAddress" data-bs-parent="#group">
            <div class="card card-body">
              <form action="updatedetails.php" method='POST'>

                <div class="mb-3">
                    <label for="newEmail" class="form-label">Enter New Business Address:</label>
                    <input type="text" class="form-control" name="newAddress">

                </div>

                <button type="submit" name ="updateAddress" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>

          <div class="collapse mb-3" id="editEmail" data-bs-parent="#group">
            <div class="card card-body">
              <form action="updatedetails.php" method='POST'>

                <div class="mb-3">
                    <label for="newPass" class="form-label">Enter New Business Email:</label>
                    <input type="text" class="form-control" name="newEmail">

                </div>

                <button type="submit" name ="updateEmail" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>

          <div class="collapse mb-3" id="editFoodTypes" data-bs-parent="#group">
            <div class="card card-body">
              <form action="updatedetails.php" method='POST'>

                <div class="mb-3">
                    <label for="newPnum" class="form-label">Enter Targeted Food Types:</label>
                    <input type="text" class="form-control" name="newTypes">

                </div>

                <button type="submit" name ="updateFoodType" class="btn btn-primary">Update</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include('includes/footer.php');?>
  </body>
</html>
