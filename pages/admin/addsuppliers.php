<?php

include '../config.php';

if (is_null($_SESSION['usrAuth'])) {
  header("Location: login.php");
}else{
  //include 'includes/usrinfo.php';
}

if(isset($_POST['addsupplier'])) {
  $selectedUserId=$_POST['userId'];
  $companyName=$_POST['cName'];
  $cEmail=$_POST['cEmail'];
  $cPhone=$_POST['cNumber'];
  $cAddress=$_POST['cAddress'];
  $cFoodTypes=$_POST['cTypes'];

  $date = date("Y-m-d");


  $args= "SELECT * FROM suppliers WHERE id='$selectedUserId'";
  $result = mysqli_query($conn, $args);
  
  if (!$result->num_rows > 0) {
    $args1 = "INSERT INTO suppliers (id, company_name, email, phone_number, address, food_types, registered_on) 
    VALUES ('$selectedUserId', '$companyName', '$cEmail', '$cPhone', '$cAddress', '$cFoodTypes', '$date')";
    $result1 = mysqli_query($conn, $args1); 
    if ($result1) {
      $args2 = "UPDATE users SET user_type=2 WHERE userid='$selectedUserId'";
      $res1 = mysqli_query($conn, $args2) or die("database error:". mysqli_error($conn));
      if ($res1)
      {
        header( "Location: managesuppliers.php?id=success" ); die;
      }else {
        header( "Location: managesuppliers.php?id=error1" ); die;
      }
  
    } else {
      header( "Location: managesuppliers.php?id=error1" ); die;
    }

  } else {
    header( "Location: managesuppliers.php?id=duplicate" ); die;
  }
    
}



if (isset($_GET['id'])){
    $id = $_GET["id"];
    if ($id == 'success'){
        echo '<div class="alert alert-success alert-dismissable" id="flash-msg">
        <h4><i class="icon fa fa-check "></i> Supplier registered successfully!</h4>
        </div>';
    }elseif($id == 'duplicate'){
        echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
        <h4><i class="icon fa fa-times "></i> Error! User is already a supplier!</h4>
        </div>';    
    }elseif($id == 'error'){
        echo '<div class="alert alert-danger alert-dismissable" id="flash-msg">
        <h4><i class="icon fa fa-times "></i> Error!</h4>
        </div>';
    }
  
}
$args = "SELECT * FROM users WHERE user_type != 1 AND userid NOT IN (SELECT id FROM suppliers)";
$users = mysqli_query($conn, $args) or die("database error:". mysqli_error($conn));
?>
<!doctype html>
<html lang="en">
  
<?php $pageTitle = "Add Supplier"; include('includes/header.php');?>

    <section>
        <div class="container p-5">
            <h1>Add a new supplier</h1>
            <p>Add a new supplier to the system to allow listing of items to the catologue</p>
        </div>
    
        <div class="container mb-5">
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label for="imageUrl" class="col-sm-2 col-form-label">Select User</label>
                  <select class="form-select" name="userId">
                    <?php while($user = mysqli_fetch_assoc($users)) { ?>
                      <option value="<?php echo $user['userid']; ?>"><?php echo $user['firstname'] . " " .$user['lastname'] . " (" . $user['email'] .")"; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="cName" class="col-sm-2 col-form-label">Company Name</label>
                  <input type="text" class="form-control" name="cName" placeholder="APU Sdn Bhd" required>
                </div>
                
                <div class="mb-3">
                  <label for="cEmail">Business Email</label>
                  <input type="text" class="form-control" name="cEmail" placeholder="example@mail.com" required>
                </div>  
                
                <div class="mb-3">
                  <label for="cNumber" class="form-label">Business Contact Number</label>
                  <input type="tel" pattern="^\d{10}$" class="form-control" name="cNumber" placeholder="012XXXXXXX" required>
                </div>

                <div class="mb-3">
                  <label for="pDesc">Business Address</label>
                  <textarea class="form-control" name="cAddress" rows="3" placeholder="Jalan Teknologi 5, Taman Teknologi Malaysia, 57000 Kuala Lumpur, Wilayah Persekutuan Kuala Lumpur" required></textarea>
                </div>  

                <div class="mb-3">
                  <label for="cTypes" class="form-label">Selling Food Types</label>
                  <input type="text" class="form-control" name="cTypes" placeholder="Organic Foods, Vegetable Supplies" required>
                </div>

                <button type="submit" name="addsupplier" class="btn btn-success">Add Supplier</button>
              </form>
        </div>
      </div>
    </section>
  <?php include('includes/footer.php');?>
</section>
