<?php


include '../config.php';

if (isset($_SESSION['usrAuth'])) {
  session_abort();
  include '../usrinfo.php';
}

$args = "SELECT * FROM suppliers";
$result = mysqli_query($conn, $args) or die("database error:". mysqli_error($conn));

if (isset($_POST['deluser'])){
  
  $query = "DELETE FROM suppliers where id=$id";

  $conn->query($query) or die($conn->error());

  echo header("Location: managesuppliers.php?id=deleted");

}

if (isset($_GET['id'])){
  $id = $_GET["id"];
  if ($id == 'invalid'){
    echo '<div class="alert alert-danger" id="flash-msg">
    <h4><i class="icon fa fa-times "></i> Invalid User ID!</h4>
    </div>';
  }elseif($id == 'updated'){
    echo '<div class="alert alert-success" id="flash-msg">
    <h4><i class="icon fa fa-check "></i> User data succesfully updated!</h4>
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
  
<?php $pageTitle = "Manage Suppliers"; include('includes/header.php');?>

    <section>
        <div class="container p-5">
            <h1>Manage suppliers</h1>
            <p>Edit or remove suppliers</p>
            <div class="form-group">
              <a type="button" href="addsuppliers.php" class="btn btn-success btn-sm float-right">Add Suppliers</a>
            </div>
        </div>
    
        <div class="container mb-3">
        <table id="catalogue" class="table table-bordered">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Company Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Food Types</th>
                <th>Status</th>
                <th>Date Registered</th>
                <th style="width: 10%"><span class="text-nowrap">Actions</span></th>
            </tr>
            </thead>
            <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>

                <td><?php echo $row ['id']; ?></td>
                <td><?php echo $row ['company_name']; ?></td>
                <td><?php echo $row ['email']; ?></td>  
                <td><?php echo $row ['phone_number']; ?></td>  
                <td><?php echo $row ['address']; ?></td>  
                <td><?php echo $row ['food_types']; ?></td>  
                <td><?php echo ($row ['isActive'] == 1) ? "Active":"Inactive"; ?></td>  
                <td><?php echo $row ['registered_on']; ?></td>  

                <td class="col col-sm-1 mb-3"><form method="POST">
                  <a href="editsupplier.php?id=<?php echo $row ['id']; ?>"><button type="button" class="btn btn-outline-dark btn-sm" name="">Edit</button></a>
                  <a href="deletesupplier.php?id=<?php echo $row ['id']; ?>"><button type="button" class="btn btn-outline-danger btn-sm" name="">Delete</button></a>
                </td>

                </tr>
            <?php } ?>
            </tbody>
        </table>
        </div>
    </section>
    <?php include('includes/footer.php');?>
  </body>
</html>
